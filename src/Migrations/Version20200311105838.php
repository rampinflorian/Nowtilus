<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311105838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv_planning (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, horodatage DATETIME NOT NULL, heure_debut DATETIME NOT NULL, heure_fin DATETIME NOT NULL, km_libre DOUBLE PRECISION NOT NULL, km_paye DOUBLE PRECISION NOT NULL, annule TINYINT(1) NOT NULL, commentaire VARCHAR(255) NOT NULL, periode VARCHAR(255) NOT NULL, INDEX IDX_B4AE275919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_recover_email (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, valid_email TINYINT(1) DEFAULT \'0\' NOT NULL, password VARCHAR(255) NOT NULL, register_date DATETIME NOT NULL, module VARCHAR(255) NOT NULL, access_level VARCHAR(255) NOT NULL, email_security_key VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rdv_planning ADD CONSTRAINT FK_B4AE275919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rdv_planning DROP FOREIGN KEY FK_B4AE275919EB6921');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE rdv_planning');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_recover_email');
    }
}
