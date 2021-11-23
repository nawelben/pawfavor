<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217150623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sitter_home (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, big_house SMALLINT DEFAULT NULL, park_nearby SMALLINT DEFAULT NULL, dog_park_nearby SMALLINT DEFAULT NULL, out_door_area SMALLINT DEFAULT NULL, fenced_backyard SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_D155E34961F367C9 (sitter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sitter_home ADD CONSTRAINT FK_D155E34961F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sitter_service_price ADD sitter_id INT NOT NULL, ADD service_id INT NOT NULL, ADD price INT NOT NULL');
        $this->addSql('ALTER TABLE sitter_service_price ADD CONSTRAINT FK_FF9EED1761F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sitter_service_price ADD CONSTRAINT FK_FF9EED17ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_FF9EED1761F367C9 ON sitter_service_price (sitter_id)');
        $this->addSql('CREATE INDEX IDX_FF9EED17ED5CA9E6 ON sitter_service_price (service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sitter_home');
        $this->addSql('ALTER TABLE sitter_service_price DROP FOREIGN KEY FK_FF9EED1761F367C9');
        $this->addSql('ALTER TABLE sitter_service_price DROP FOREIGN KEY FK_FF9EED17ED5CA9E6');
        $this->addSql('DROP INDEX IDX_FF9EED1761F367C9 ON sitter_service_price');
        $this->addSql('DROP INDEX IDX_FF9EED17ED5CA9E6 ON sitter_service_price');
        $this->addSql('ALTER TABLE sitter_service_price DROP sitter_id, DROP service_id, DROP price');
    }
}
