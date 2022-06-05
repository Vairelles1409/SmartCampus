<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605121631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE batiment ALTER nom_batiment DROP NOT NULL');
        $this->addSql('ALTER TABLE batiment ALTER longitude DROP NOT NULL');
        $this->addSql('ALTER TABLE batiment ALTER latitude DROP NOT NULL');
        $this->addSql('ALTER TABLE batiment ALTER altitude SET NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD date_reservation_fin VARCHAR(255) DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN reservation.date_reservation_fin IS \'(DC2Type:dateinterval)\'');
        $this->addSql('ALTER TABLE salle ALTER numero_salle SET NOT NULL');
        $this->addSql('ALTER TABLE salle ALTER altitude DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE batiment ALTER nom_batiment SET NOT NULL');
        $this->addSql('ALTER TABLE batiment ALTER longitude SET NOT NULL');
        $this->addSql('ALTER TABLE batiment ALTER latitude SET NOT NULL');
        $this->addSql('ALTER TABLE batiment ALTER altitude DROP NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP date_reservation_fin');
        $this->addSql('ALTER TABLE salle ALTER numero_salle DROP NOT NULL');
        $this->addSql('ALTER TABLE salle ALTER altitude SET NOT NULL');
    }
}
