<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201229095433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD recipient_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744E92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_90651744E92F8F78 ON invoice (recipient_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_90651744E92F8F78');
        $this->addSql('DROP INDEX IDX_90651744E92F8F78 ON invoice');
        $this->addSql('ALTER TABLE invoice DROP recipient_id');
    }
}
