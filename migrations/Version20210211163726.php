<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211163726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE heures_intervenants (heures_id INT NOT NULL, intervenants_id INT NOT NULL, INDEX IDX_B8F018F9D05B21E6 (heures_id), INDEX IDX_B8F018F9130E9263 (intervenants_id), PRIMARY KEY(heures_id, intervenants_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heures_intervenants ADD CONSTRAINT FK_B8F018F9D05B21E6 FOREIGN KEY (heures_id) REFERENCES heures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE heures_intervenants ADD CONSTRAINT FK_B8F018F9130E9263 FOREIGN KEY (intervenants_id) REFERENCES intervenants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE heures ADD jour_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE heures ADD CONSTRAINT FK_DEA5875D7D6C3F24 FOREIGN KEY (jour_id_id) REFERENCES jours (id)');
        $this->addSql('CREATE INDEX IDX_DEA5875D7D6C3F24 ON heures (jour_id_id)');
        $this->addSql('ALTER TABLE jours ADD semaine_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE jours ADD CONSTRAINT FK_F0DAEEEDB54FCCFD FOREIGN KEY (semaine_id_id) REFERENCES semaines (id)');
        $this->addSql('CREATE INDEX IDX_F0DAEEEDB54FCCFD ON jours (semaine_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE heures_intervenants');
        $this->addSql('ALTER TABLE heures DROP FOREIGN KEY FK_DEA5875D7D6C3F24');
        $this->addSql('DROP INDEX IDX_DEA5875D7D6C3F24 ON heures');
        $this->addSql('ALTER TABLE heures DROP jour_id_id');
        $this->addSql('ALTER TABLE jours DROP FOREIGN KEY FK_F0DAEEEDB54FCCFD');
        $this->addSql('DROP INDEX IDX_F0DAEEEDB54FCCFD ON jours');
        $this->addSql('ALTER TABLE jours DROP semaine_id_id');
    }
}
