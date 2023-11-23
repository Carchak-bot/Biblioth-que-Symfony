<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123144621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP INDEX UNIQ_AC634F994EACD152, ADD INDEX IDX_AC634F994EACD152 (id_emprunteur_id)');
        $this->addSql('ALTER TABLE membres CHANGE photo_name photo_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre DROP INDEX IDX_AC634F994EACD152, ADD UNIQUE INDEX UNIQ_AC634F994EACD152 (id_emprunteur_id)');
        $this->addSql('ALTER TABLE membres CHANGE photo_name photo_name VARCHAR(255) NOT NULL');
    }
}
