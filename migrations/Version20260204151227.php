<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260204151227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country ADD team_id INT NOT NULL');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_5373C966296CD8AE ON country (team_id)');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY `FK_C4E0A61FF92F3E70`');
        $this->addSql('DROP INDEX IDX_C4E0A61FF92F3E70 ON team');
        $this->addSql('ALTER TABLE team DROP country_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966296CD8AE');
        $this->addSql('DROP INDEX IDX_5373C966296CD8AE ON country');
        $this->addSql('ALTER TABLE country DROP team_id');
        $this->addSql('ALTER TABLE team ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT `FK_C4E0A61FF92F3E70` FOREIGN KEY (country_id) REFERENCES country (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C4E0A61FF92F3E70 ON team (country_id)');
    }
}
