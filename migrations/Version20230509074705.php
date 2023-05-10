<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509074705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice CHANGE name name VARCHAR(180) NOT NULL, CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance CHANGE name name VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE user ADD picture_file VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(60) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP picture_file, CHANGE email email VARCHAR(60) NOT NULL, CHANGE username username VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE seance CHANGE name name VARCHAR(255) NOT NULL');
    }
}
