<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417112218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance ADD created_at DATE DEFAULT NULL, DROP create_at');
        $this->addSql('ALTER TABLE user ADD created_at DATE DEFAULT NULL, DROP create_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance ADD create_at DATE DEFAULT NULL, DROP created_at');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
