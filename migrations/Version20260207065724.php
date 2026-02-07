<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260207065724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE championship ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE championship ADD CONSTRAINT FK_EBADDE6A296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_EBADDE6A296CD8AE ON championship (team_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE championship DROP FOREIGN KEY FK_EBADDE6A296CD8AE');
        $this->addSql('DROP INDEX IDX_EBADDE6A296CD8AE ON championship');
        $this->addSql('ALTER TABLE championship DROP team_id');
    }
}
