<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106110730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3AF34668727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couleur (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, id_client VARCHAR(255) NOT NULL, id_vetement VARCHAR(255) NOT NULL, INDEX IDX_8933C43219EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, genre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B379F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetements (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, couleur_id INT NOT NULL, taille_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, style_id INT DEFAULT NULL, favoris_id INT DEFAULT NULL, client_id INT NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_10E9A46CBCF5E72D (categorie_id), INDEX IDX_10E9A46CC31BA576 (couleur_id), INDEX IDX_10E9A46CFF25611A (taille_id), INDEX IDX_10E9A46C4827B9B2 (marque_id), INDEX IDX_10E9A46CBACD6074 (style_id), INDEX IDX_10E9A46C51E8871B (favoris_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43219EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B379F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CFF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46C4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CBACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46C51E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668727ACA70');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CBCF5E72D');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CC31BA576');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46C51E8871B');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46C4827B9B2');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CBACD6074');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CFF25611A');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C43219EB6921');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vetements');
    }
}
