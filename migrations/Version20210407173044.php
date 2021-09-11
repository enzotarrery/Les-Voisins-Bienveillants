<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407173044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_tache (utilisateur_id INT NOT NULL, tache_id INT NOT NULL, INDEX IDX_554278ABFB88E14F (utilisateur_id), INDEX IDX_554278ABD2235D39 (tache_id), PRIMARY KEY(utilisateur_id, tache_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_tache ADD CONSTRAINT FK_554278ABFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_tache ADD CONSTRAINT FK_554278ABD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075FB88E14F');
        $this->addSql('DROP INDEX IDX_93872075FB88E14F ON tache');
        $this->addSql('ALTER TABLE tache DROP utilisateur_id');
        $this->addSql('ALTER TABLE utilisateur DROP taches');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateur_tache');
        $this->addSql('ALTER TABLE tache ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_93872075FB88E14F ON tache (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur ADD taches VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
