<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217145516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE owner_about (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, about VARCHAR(800) DEFAULT NULL, UNIQUE INDEX UNIQ_456D17C47E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saved_sitters (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, sitter_id INT NOT NULL, INDEX IDX_9700C7307E3C61F9 (owner_id), INDEX IDX_9700C73061F367C9 (sitter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sitter_about (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, short VARCHAR(255) DEFAULT NULL, long_description VARCHAR(1500) DEFAULT NULL, UNIQUE INDEX UNIQ_3C878AEC61F367C9 (sitter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE owner_about ADD CONSTRAINT FK_456D17C47E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE saved_sitters ADD CONSTRAINT FK_9700C7307E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE saved_sitters ADD CONSTRAINT FK_9700C73061F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sitter_about ADD CONSTRAINT FK_3C878AEC61F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE owner_about');
        $this->addSql('DROP TABLE saved_sitters');
        $this->addSql('DROP TABLE sitter_about');
    }
}
