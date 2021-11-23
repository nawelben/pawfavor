<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210212143525 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sitter_pet_category (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, xsmall SMALLINT DEFAULT NULL, small SMALLINT DEFAULT NULL, medium SMALLINT DEFAULT NULL, large SMALLINT DEFAULT NULL, xlarge SMALLINT DEFAULT NULL, cats SMALLINT DEFAULT NULL, birds SMALLINT DEFAULT NULL, guineapigs SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_621F90C861F367C9 (sitter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sitter_service_price (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sitter_pet_category ADD CONSTRAINT FK_621F90C861F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE pet ADD category VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sitter_pet_category');
        $this->addSql('DROP TABLE sitter_service_price');
        $this->addSql('ALTER TABLE message DROP state');
        $this->addSql('ALTER TABLE pet DROP category');
    }
}
