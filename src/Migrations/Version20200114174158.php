<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114174158 extends AbstractMigration
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
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, INDEX IDX_EF85A2CC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori_vetements (favori_id INT NOT NULL, vetements_id INT NOT NULL, INDEX IDX_1B971C74FF17033F (favori_id), INDEX IDX_1B971C743431D455 (vetements_id), PRIMARY KEY(favori_id, vetements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, genre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B379F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetement2 (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, categorie VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, taille VARCHAR(255) DEFAULT NULL, style VARCHAR(255) NOT NULL, marque VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_1132D56ADC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetements (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, couleur_id INT NOT NULL, taille_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, style_id INT DEFAULT NULL, client_id INT NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_10E9A46CBCF5E72D (categorie_id), INDEX IDX_10E9A46CC31BA576 (couleur_id), INDEX IDX_10E9A46CFF25611A (taille_id), INDEX IDX_10E9A46C4827B9B2 (marque_id), INDEX IDX_10E9A46CBACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE favori ADD CONSTRAINT FK_EF85A2CC19EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE favori_vetements ADD CONSTRAINT FK_1B971C74FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favori_vetements ADD CONSTRAINT FK_1B971C743431D455 FOREIGN KEY (vetements_id) REFERENCES vetements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B379F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vetement2 ADD CONSTRAINT FK_1132D56ADC2902E0 FOREIGN KEY (client_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CFF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46C4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CBACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668727ACA70');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CBCF5E72D');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CC31BA576');
        $this->addSql('ALTER TABLE favori_vetements DROP FOREIGN KEY FK_1B971C74FF17033F');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46C4827B9B2');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CBACD6074');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CFF25611A');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B379F37AE5');
        $this->addSql('ALTER TABLE favori DROP FOREIGN KEY FK_EF85A2CC19EB6921');
        $this->addSql('ALTER TABLE vetement2 DROP FOREIGN KEY FK_1132D56ADC2902E0');
        $this->addSql('ALTER TABLE favori_vetements DROP FOREIGN KEY FK_1B971C743431D455');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE couleur');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE favori_vetements');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vetement2');
        $this->addSql('DROP TABLE vetements');
    }
}
