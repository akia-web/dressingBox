<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106112551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46C51E8871B');
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, INDEX IDX_EF85A2CC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori_vetements (favori_id INT NOT NULL, vetements_id INT NOT NULL, INDEX IDX_1B971C74FF17033F (favori_id), INDEX IDX_1B971C743431D455 (vetements_id), PRIMARY KEY(favori_id, vetements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favori ADD CONSTRAINT FK_EF85A2CC19EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE favori_vetements ADD CONSTRAINT FK_1B971C74FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favori_vetements ADD CONSTRAINT FK_1B971C743431D455 FOREIGN KEY (vetements_id) REFERENCES vetements (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP INDEX IDX_10E9A46C51E8871B ON vetements');
        $this->addSql('ALTER TABLE vetements DROP favoris_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favori_vetements DROP FOREIGN KEY FK_1B971C74FF17033F');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, INDEX IDX_8933C43219EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43219EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE favori_vetements');
        $this->addSql('ALTER TABLE vetements ADD favoris_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46C51E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id)');
        $this->addSql('CREATE INDEX IDX_10E9A46C51E8871B ON vetements (favoris_id)');
    }
}
