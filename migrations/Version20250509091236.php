<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509091236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD idsweatshirt_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD link VARCHAR(255) NOT NULL, ADD alt LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image ADD CONSTRAINT FK_C53D045FD8D9BCA0 FOREIGN KEY (idsweatshirt_id) REFERENCES sweat_shirt (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C53D045FD8D9BCA0 ON image (idsweatshirt_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sweat_shirt ADD name VARCHAR(255) NOT NULL, ADD size VARCHAR(255) NOT NULL, ADD stock_xs INT NOT NULL, ADD stock_s INT NOT NULL, ADD stock_m INT NOT NULL, ADD stock_l INT NOT NULL, ADD stock_xl INT NOT NULL, ADD price NUMERIC(10, 2) NOT NULL, ADD top TINYINT(1) DEFAULT 0 NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL COMMENT '(DC2Type:json)', ADD password VARCHAR(255) NOT NULL, ADD delivery_adress VARCHAR(255) DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD8D9BCA0
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C53D045FD8D9BCA0 ON image
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE image DROP idsweatshirt_id, DROP name, DROP link, DROP alt
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sweat_shirt DROP name, DROP size, DROP stock_xs, DROP stock_s, DROP stock_m, DROP stock_l, DROP stock_xl, DROP price, DROP top
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP email, DROP roles, DROP password, DROP delivery_adress, DROP name, DROP is_verified
        SQL);
    }
}
