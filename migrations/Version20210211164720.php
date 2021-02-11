<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211164720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE heures_matieres (heures_id INT NOT NULL, matieres_id INT NOT NULL, INDEX IDX_44139DC6D05B21E6 (heures_id), INDEX IDX_44139DC682350831 (matieres_id), PRIMARY KEY(heures_id, matieres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heures_matieres ADD CONSTRAINT FK_44139DC6D05B21E6 FOREIGN KEY (heures_id) REFERENCES heures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE heures_matieres ADD CONSTRAINT FK_44139DC682350831 FOREIGN KEY (matieres_id) REFERENCES matieres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alternants ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE alternants ADD CONSTRAINT FK_B508067E9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B508067E9D86650F ON alternants (user_id_id)');
        $this->addSql('ALTER TABLE intervenants ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C09D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_79A002C09D86650F ON intervenants (user_id_id)');
        $this->addSql('ALTER TABLE matieres ADD intervenant_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matieres ADD CONSTRAINT FK_8D9773D26BB3E495 FOREIGN KEY (intervenant_id_id) REFERENCES intervenants (id)');
        $this->addSql('CREATE INDEX IDX_8D9773D26BB3E495 ON matieres (intervenant_id_id)');
        $this->addSql('ALTER TABLE secretaires ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE secretaires ADD CONSTRAINT FK_9DA0A81D9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9DA0A81D9D86650F ON secretaires (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE heures_matieres');
        $this->addSql('ALTER TABLE alternants DROP FOREIGN KEY FK_B508067E9D86650F');
        $this->addSql('DROP INDEX UNIQ_B508067E9D86650F ON alternants');
        $this->addSql('ALTER TABLE alternants DROP user_id_id');
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C09D86650F');
        $this->addSql('DROP INDEX UNIQ_79A002C09D86650F ON intervenants');
        $this->addSql('ALTER TABLE intervenants DROP user_id_id');
        $this->addSql('ALTER TABLE matieres DROP FOREIGN KEY FK_8D9773D26BB3E495');
        $this->addSql('DROP INDEX IDX_8D9773D26BB3E495 ON matieres');
        $this->addSql('ALTER TABLE matieres DROP intervenant_id_id');
        $this->addSql('ALTER TABLE secretaires DROP FOREIGN KEY FK_9DA0A81D9D86650F');
        $this->addSql('DROP INDEX UNIQ_9DA0A81D9D86650F ON secretaires');
        $this->addSql('ALTER TABLE secretaires DROP user_id_id');
    }
}
