<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609125411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE periode ADD libelle VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE periode DROP periode_rservation');
        $this->addSql('ALTER TABLE reservation ADD periode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP etat');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F384C1CF FOREIGN KEY (periode_id) REFERENCES periode (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_42C84955F384C1CF ON reservation (periode_id)');
        $this->addSql('ALTER TABLE salle ADD etat INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE periode ADD periode_rservation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE periode DROP libelle');
        $this->addSql('ALTER TABLE salle DROP etat');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955F384C1CF');
        $this->addSql('DROP INDEX IDX_42C84955F384C1CF');
        $this->addSql('ALTER TABLE reservation ADD etat BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation DROP periode_id');
    }
}
