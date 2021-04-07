<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407191154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD role VARCHAR(255) NOT NULL, DROP role, DROP nom, DROP prenom, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE alternants ADD CONSTRAINT FK_B508067E376858A8 FOREIGN KEY (id_users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B508067E376858A8 ON alternants (id_users_id)');
        $this->addSql('ALTER TABLE calendar ADD id_matiere_id INT DEFAULT NULL, DROP background_color, DROP border_color, DROP text_color');
        $this->addSql('ALTER TABLE calendar ADD CONSTRAINT FK_6EA9A14651E6528F FOREIGN KEY (id_matiere_id) REFERENCES matieres (id)');
        $this->addSql('CREATE INDEX IDX_6EA9A14651E6528F ON calendar (id_matiere_id)');
        $this->addSql('ALTER TABLE intervenants ADD id_users_id INT NOT NULL, DROP nom_intervenant, DROP prenom_intervenant, DROP mail_intervenant, DROP password');
        $this->addSql('ALTER TABLE intervenants ADD CONSTRAINT FK_79A002C0376858A8 FOREIGN KEY (id_users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_79A002C0376858A8 ON intervenants (id_users_id)');
        $this->addSql('ALTER TABLE matieres DROP FOREIGN KEY FK_8D9773D26BB3E495');
        $this->addSql('DROP INDEX IDX_8D9773D26BB3E495 ON matieres');
        $this->addSql('ALTER TABLE matieres ADD nom VARCHAR(255) NOT NULL, ADD background_color VARCHAR(7) NOT NULL, ADD text_color VARCHAR(7) NOT NULL, ADD border_color VARCHAR(7) NOT NULL, DROP intervenant_id_id, DROP nom_matiere, CHANGE nb_heures_matiere nb_heure INT NOT NULL');
        $this->addSql('ALTER TABLE secretaires DROP FOREIGN KEY FK_9DA0A81D9D86650F');
        $this->addSql('DROP INDEX UNIQ_9DA0A81D9D86650F ON secretaires');
        $this->addSql('ALTER TABLE secretaires DROP nom_secretaire, DROP prenom_secretaire, DROP mail_secretaire, DROP password, CHANGE user_id_id id_users_id INT NOT NULL');
        $this->addSql('ALTER TABLE secretaires ADD CONSTRAINT FK_9DA0A81D376858A8 FOREIGN KEY (id_users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9DA0A81D376858A8 ON secretaires (id_users_id)');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternants DROP FOREIGN KEY FK_B508067E376858A8');
        $this->addSql('DROP INDEX UNIQ_B508067E376858A8 ON alternants');
        $this->addSql('ALTER TABLE calendar DROP FOREIGN KEY FK_6EA9A14651E6528F');
        $this->addSql('DROP INDEX IDX_6EA9A14651E6528F ON calendar');
        $this->addSql('ALTER TABLE calendar ADD background_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD border_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD text_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP id_matiere_id');
        $this->addSql('ALTER TABLE intervenants DROP FOREIGN KEY FK_79A002C0376858A8');
        $this->addSql('DROP INDEX UNIQ_79A002C0376858A8 ON intervenants');
        $this->addSql('ALTER TABLE intervenants ADD nom_intervenant VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom_intervenant VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD mail_intervenant VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP id_users_id');
        $this->addSql('ALTER TABLE matieres ADD intervenant_id_id INT DEFAULT NULL, ADD nom_matiere VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom, DROP background_color, DROP text_color, DROP border_color, CHANGE nb_heure nb_heures_matiere INT NOT NULL');
        $this->addSql('ALTER TABLE matieres ADD CONSTRAINT FK_8D9773D26BB3E495 FOREIGN KEY (intervenant_id_id) REFERENCES intervenants (id)');
        $this->addSql('CREATE INDEX IDX_8D9773D26BB3E495 ON matieres (intervenant_id_id)');
        $this->addSql('ALTER TABLE secretaires DROP FOREIGN KEY FK_9DA0A81D376858A8');
        $this->addSql('DROP INDEX UNIQ_9DA0A81D376858A8 ON secretaires');
        $this->addSql('ALTER TABLE secretaires ADD nom_secretaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom_secretaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD mail_secretaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id_users_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE secretaires ADD CONSTRAINT FK_9DA0A81D9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9DA0A81D9D86650F ON secretaires (user_id_id)');
        $this->addSql('ALTER TABLE users ADD roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', ADD nom_user VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD prenom_user VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom, DROP prenom, DROP role, CHANGE email email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }
}
