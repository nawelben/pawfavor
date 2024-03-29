<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216141308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA3E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF5476CA3E2E969B ON notification (review_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA3E2E969B');
        $this->addSql('DROP INDEX UNIQ_BF5476CA3E2E969B ON notification');
        $this->addSql('ALTER TABLE notification DROP review_id');
    }
}
