<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217161555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paddock (id INT AUTO_INCREMENT NOT NULL, space_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, area INT NOT NULL, max_animals INT NOT NULL, quarantine TINYINT(1) NOT NULL, INDEX IDX_BD616EDA23575340 (space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, size DOUBLE PRECISION NOT NULL, open_date DATE DEFAULT NOT NULL, close_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE paddock ADD CONSTRAINT FK_BD616EDA23575340 FOREIGN KEY (space_id) REFERENCES space (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paddock DROP FOREIGN KEY FK_BD616EDA23575340');
        $this->addSql('DROP TABLE paddock');
        $this->addSql('DROP TABLE space');
    }
}
