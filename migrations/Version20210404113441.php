<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404113441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C09D86650F');
        $this->addSql('DROP INDEX UNIQ_79A002C09D86650F ON intervenants');
        $this->addSql('ALTER TABLE intervenants DROP user_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervenants ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C09D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_79A002C09D86650F ON intervenants (user_id_id)');
    }
}
