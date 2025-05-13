<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

#[AsCommand(name: 'app:generate-docs')]
class GenerateDocsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Chemin relatif depuis la racine du projet
        $outputDir = 'public/docs/';

        // Crée le dossier s'il n'existe pas
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml('<h1>Mon PDF</h1>');
        $dompdf->render();

        // Chemin complet du fichier
        $pdfPath = $outputDir . 'documentation.pdf';

        file_put_contents($pdfPath, $dompdf->output());

        $output->writeln('PDF généré: ' . $pdfPath);

        return Command::SUCCESS;
    }
}
