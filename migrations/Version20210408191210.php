<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408191210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar ADD id_inter_id INT NOT NULL');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A146B8837C0B FOREIGN KEY (id_inter_id) REFERENCES intervenants (id)');
        $this->addSql('CREATE INDEX IDX_6EA9A146B8837C0B ON calendar (id_inter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A146B8837C0B');
        $this->addSql('DROP INDEX IDX_6EA9A146B8837C0B ON calendar');
        $this->addSql('ALTER TABLE calendar DROP id_inter_id');
    }
}
