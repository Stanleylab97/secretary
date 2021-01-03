<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103190248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, direction_id INT DEFAULT NULL, service_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, INDEX IDX_268B9C9DAF73D997 (direction_id), INDEX IDX_268B9C9DED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribution_vehicule (id INT AUTO_INCREMENT NOT NULL, chauffeur_id INT NOT NULL, vehicule_id INT NOT NULL, date_affectation DATE NOT NULL, INDEX IDX_E444F39E85C0B3BE (chauffeur_id), INDEX IDX_E444F39E4A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chauffeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, contacts VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, lieu VARCHAR(255) NOT NULL, moyen VARCHAR(255) NOT NULL, chef_mission VARCHAR(255) NOT NULL, prime_chef INT NOT NULL, objet LONGTEXT NOT NULL, note_service VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, date_retour DATE NOT NULL, nbjrs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parc_auto (id INT AUTO_INCREMENT NOT NULL, immatriculation VARCHAR(8) NOT NULL, marque VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, consommation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenoms VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, direction_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD2AF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet_mission (id INT AUTO_INCREMENT NOT NULL, mission_id INT NOT NULL, lieu_depart VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, heure_depart TIME NOT NULL, date_retour DATE NOT NULL, lieu_retour VARCHAR(255) NOT NULL, heure_retour_approximatif TIME NOT NULL, INDEX IDX_E2D0F348BE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DAF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE attribution_vehicule ADD CONSTRAINT FK_E444F39E85C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE attribution_vehicule ADD CONSTRAINT FK_E444F39E4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES parc_auto (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
        $this->addSql('ALTER TABLE trajet_mission ADD CONSTRAINT FK_E2D0F348BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DAF73D997');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2AF73D997');
        $this->addSql('ALTER TABLE trajet_mission DROP FOREIGN KEY FK_E2D0F348BE6CAE90');
        $this->addSql('ALTER TABLE attribution_vehicule DROP FOREIGN KEY FK_E444F39E4A4A3511');
        $this->addSql('ALTER TABLE attribution_vehicule DROP FOREIGN KEY FK_E444F39E85C0B3BE');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DED5CA9E6');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE attribution_vehicule');
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE parc_auto');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE trajet_mission');
    }
}