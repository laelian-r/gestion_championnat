<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260206140911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_championship (id INT AUTO_INCREMENT NOT NULL, championship_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_E32BD3A894DDBCE9 (championship_id), INDEX IDX_E32BD3A8296CD8AE (team_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE team_championship ADD CONSTRAINT FK_E32BD3A894DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('ALTER TABLE team_championship ADD CONSTRAINT FK_E32BD3A8296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_champion_ship DROP FOREIGN KEY `FK_43024F0C296CD8AE`');
        $this->addSql('ALTER TABLE team_champion_ship DROP FOREIGN KEY `FK_43024F0C94DDBCE9`');
        $this->addSql('DROP TABLE team_champion_ship');
        $this->addSql('ALTER TABLE country CHANGE team_id team_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE team_champion_ship (id INT AUTO_INCREMENT NOT NULL, championship_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_43024F0C94DDBCE9 (championship_id), INDEX IDX_43024F0C296CD8AE (team_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE team_champion_ship ADD CONSTRAINT `FK_43024F0C296CD8AE` FOREIGN KEY (team_id) REFERENCES team (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_champion_ship ADD CONSTRAINT `FK_43024F0C94DDBCE9` FOREIGN KEY (championship_id) REFERENCES championship (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_championship DROP FOREIGN KEY FK_E32BD3A894DDBCE9');
        $this->addSql('ALTER TABLE team_championship DROP FOREIGN KEY FK_E32BD3A8296CD8AE');
        $this->addSql('DROP TABLE team_championship');
        $this->addSql('ALTER TABLE country CHANGE team_id team_id INT NOT NULL');
    }
}
