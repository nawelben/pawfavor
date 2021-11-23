<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211210719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, owner_id INT NOT NULL, service_id INT NOT NULL, state VARCHAR(255) NOT NULL, start DATE NOT NULL, end DATE NOT NULL, total_price DOUBLE PRECISION NOT NULL, INDEX IDX_E00CEDDE61F367C9 (sitter_id), INDEX IDX_E00CEDDE7E3C61F9 (owner_id), INDEX IDX_E00CEDDEED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_detail (id INT AUTO_INCREMENT NOT NULL, pet_id INT DEFAULT NULL, booking_id INT NOT NULL, unknown_pet VARCHAR(255) DEFAULT NULL, INDEX IDX_959C446D966F7FB6 (pet_id), INDEX IDX_959C446D3301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE disponibility (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, service_id INT NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, supplement_price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_38BB926061F367C9 (sitter_id), INDEX IDX_38BB9260ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, reciever_id INT NOT NULL, content VARCHAR(500) NOT NULL, date DATETIME NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307F5D5C928D (reciever_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, booking_id INT NOT NULL, INDEX IDX_6D28840D61F367C9 (sitter_id), UNIQUE INDEX UNIQ_6D28840D3301C60 (booking_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, owner_id INT NOT NULL, rate INT NOT NULL, comment VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_794381C661F367C9 (sitter_id), INDEX IDX_794381C67E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sitter_skill (id INT AUTO_INCREMENT NOT NULL, sitter_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_D74E4C7861F367C9 (sitter_id), INDEX IDX_D74E4C785585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE61F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE booking_detail ADD CONSTRAINT FK_959C446D966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id)');
        $this->addSql('ALTER TABLE booking_detail ADD CONSTRAINT FK_959C446D3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE disponibility ADD CONSTRAINT FK_38BB926061F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE disponibility ADD CONSTRAINT FK_38BB9260ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5D5C928D FOREIGN KEY (reciever_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D61F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C661F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C67E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sitter_skill ADD CONSTRAINT FK_D74E4C7861F367C9 FOREIGN KEY (sitter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sitter_skill ADD CONSTRAINT FK_D74E4C785585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking_detail DROP FOREIGN KEY FK_959C446D3301C60');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D3301C60');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEED5CA9E6');
        $this->addSql('ALTER TABLE disponibility DROP FOREIGN KEY FK_38BB9260ED5CA9E6');
        $this->addSql('ALTER TABLE sitter_skill DROP FOREIGN KEY FK_D74E4C785585C142');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_detail');
        $this->addSql('DROP TABLE disponibility');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE sitter_skill');
        $this->addSql('DROP TABLE skill');
    }
}
