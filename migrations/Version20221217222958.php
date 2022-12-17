<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217222958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, paddock_id INT DEFAULT NULL, identification_number VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, brith_date DATE DEFAULT NULL, arrival_date DATE NOT NULL, departure_date DATE DEFAULT NULL, property TINYINT(1) NOT NULL, gender VARCHAR(20) DEFAULT NULL, species VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, sterilized TINYINT(1) NOT NULL, quarantaine TINYINT(1) NOT NULL, INDEX IDX_6AAB231F2794628C (paddock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paddock (id INT AUTO_INCREMENT NOT NULL, space_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, area INT NOT NULL, max_animals INT NOT NULL, quarantine TINYINT(1) NOT NULL, INDEX IDX_BD616EDA23575340 (space_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, size DOUBLE PRECISION NOT NULL, open_date DATE DEFAULT NULL, close_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F2794628C FOREIGN KEY (paddock_id) REFERENCES paddock (id)');
        $this->addSql('ALTER TABLE paddock ADD CONSTRAINT FK_BD616EDA23575340 FOREIGN KEY (space_id) REFERENCES space (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F2794628C');
        $this->addSql('ALTER TABLE paddock DROP FOREIGN KEY FK_BD616EDA23575340');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE paddock');
        $this->addSql('DROP TABLE space');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
