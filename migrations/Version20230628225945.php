<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628225945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT fk_fbce3e7a79f37ae5');
        $this->addSql('DROP INDEX idx_fbce3e7a79f37ae5');
        $this->addSql('ALTER TABLE subject RENAME COLUMN id_user_id TO user_id');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FBCE3E7AA76ED395 ON subject (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE subject DROP CONSTRAINT FK_FBCE3E7AA76ED395');
        $this->addSql('DROP INDEX IDX_FBCE3E7AA76ED395');
        $this->addSql('ALTER TABLE subject RENAME COLUMN user_id TO id_user_id');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT fk_fbce3e7a79f37ae5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fbce3e7a79f37ae5 ON subject (id_user_id)');
    }
}
