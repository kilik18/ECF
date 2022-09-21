<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220921084922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE global_permission (id INT AUTO_INCREMENT NOT NULL, local_permission_id INT DEFAULT NULL, activated TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_6946B8217056E6B4 (local_permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE local_permission (id INT AUTO_INCREMENT NOT NULL, activated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(50) NOT NULL, url VARCHAR(100) DEFAULT NULL, short_description VARCHAR(150) DEFAULT NULL, technical_contact BIGINT NOT NULL, commercial_contact BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_global_permission (partner_id INT NOT NULL, global_permission_id INT NOT NULL, INDEX IDX_C55297B49393F8FE (partner_id), INDEX IDX_C55297B4EC6D299B (global_permission_id), PRIMARY KEY(partner_id, global_permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(100) NOT NULL, short_description VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure_local_permission (structure_id INT NOT NULL, local_permission_id INT NOT NULL, INDEX IDX_BFBDA3502534008B (structure_id), INDEX IDX_BFBDA3507056E6B4 (local_permission_id), PRIMARY KEY(structure_id, local_permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, structure_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, activated TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6499393F8FE (partner_id), UNIQUE INDEX UNIQ_8D93D6492534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE global_permission ADD CONSTRAINT FK_6946B8217056E6B4 FOREIGN KEY (local_permission_id) REFERENCES local_permission (id)');
        $this->addSql('ALTER TABLE partner_global_permission ADD CONSTRAINT FK_C55297B49393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partner_global_permission ADD CONSTRAINT FK_C55297B4EC6D299B FOREIGN KEY (global_permission_id) REFERENCES global_permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_local_permission ADD CONSTRAINT FK_BFBDA3502534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_local_permission ADD CONSTRAINT FK_BFBDA3507056E6B4 FOREIGN KEY (local_permission_id) REFERENCES local_permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6492534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE global_permission DROP FOREIGN KEY FK_6946B8217056E6B4');
        $this->addSql('ALTER TABLE partner_global_permission DROP FOREIGN KEY FK_C55297B49393F8FE');
        $this->addSql('ALTER TABLE partner_global_permission DROP FOREIGN KEY FK_C55297B4EC6D299B');
        $this->addSql('ALTER TABLE structure_local_permission DROP FOREIGN KEY FK_BFBDA3502534008B');
        $this->addSql('ALTER TABLE structure_local_permission DROP FOREIGN KEY FK_BFBDA3507056E6B4');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499393F8FE');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6492534008B');
        $this->addSql('DROP TABLE global_permission');
        $this->addSql('DROP TABLE local_permission');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE partner_global_permission');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE structure_local_permission');
        $this->addSql('DROP TABLE `user`');
    }
}
