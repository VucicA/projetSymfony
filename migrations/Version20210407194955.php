<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407194955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternants ADD id_spe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alternants ADD CONSTRAINT FK_B508067E766990FD FOREIGN KEY (id_spe_id) REFERENCES specialisations (id)');
        $this->addSql('CREATE INDEX IDX_B508067E766990FD ON alternants (id_spe_id)');
        $this->addSql('ALTER TABLE disponnibilites ADD idinter_id INT NOT NULL');
        $this->addSql('ALTER TABLE disponnibilites ADD CONSTRAINT FK_E2292B58428DD893 FOREIGN KEY (idinter_id) REFERENCES intervenants (id)');
        $this->addSql('CREATE INDEX IDX_E2292B58428DD893 ON disponnibilites (idinter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternants DROP FOREIGN KEY FK_B508067E766990FD');
        $this->addSql('DROP INDEX IDX_B508067E766990FD ON alternants');
        $this->addSql('ALTER TABLE alternants DROP id_spe_id');
        $this->addSql('ALTER TABLE disponnibilites DROP FOREIGN KEY FK_E2292B58428DD893');
        $this->addSql('DROP INDEX IDX_E2292B58428DD893 ON disponnibilites');
        $this->addSql('ALTER TABLE disponnibilites DROP idinter_id');
    }
}
