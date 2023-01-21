<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121082307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time_management ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE time_management ADD CONSTRAINT FK_83D4B9A2166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_83D4B9A2166D1F9C ON time_management (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE time_management DROP FOREIGN KEY FK_83D4B9A2166D1F9C');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP INDEX IDX_83D4B9A2166D1F9C ON time_management');
        $this->addSql('ALTER TABLE time_management DROP project_id');
    }
}
