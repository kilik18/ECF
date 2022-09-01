<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901063911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EABDE7F1C6');
        $this->addSql('DROP INDEX IDX_6F0137EABDE7F1C6 ON structure');
        $this->addSql('ALTER TABLE structure CHANGE partners_id partner_id INT NOT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_6F0137EA9393F8FE ON structure (partner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA9393F8FE');
        $this->addSql('DROP INDEX IDX_6F0137EA9393F8FE ON structure');
        $this->addSql('ALTER TABLE structure CHANGE partner_id partners_id INT NOT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EABDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_6F0137EABDE7F1C6 ON structure (partners_id)');
    }
}
