<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817132655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE global_permission (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, partner_id INT NOT NULL, activated TINYINT(1) NOT NULL, INDEX IDX_6946B82161220EA6 (creator_id), INDEX IDX_6946B8219393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE local_permission (id INT AUTO_INCREMENT NOT NULL, structure_id INT NOT NULL, global_permission_id INT NOT NULL, activated TINYINT(1) NOT NULL, INDEX IDX_826AC8FA2534008B (structure_id), UNIQUE INDEX UNIQ_826AC8FAEC6D299B (global_permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, partner_name VARCHAR(100) NOT NULL, partner_mail VARCHAR(100) NOT NULL, partner_password VARCHAR(100) NOT NULL, url VARCHAR(200) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, technical_contact BIGINT NOT NULL, commercial_contact BIGINT NOT NULL, activated TINYINT(1) NOT NULL, INDEX IDX_312B3E1661220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, partner_id INT NOT NULL, structure_name VARCHAR(100) NOT NULL, structure_mail VARCHAR(100) NOT NULL, structure_password VARCHAR(100) NOT NULL, manager_name VARCHAR(100) NOT NULL, short_description LONGTEXT DEFAULT NULL, activated TINYINT(1) NOT NULL, INDEX IDX_6F0137EA61220EA6 (creator_id), INDEX IDX_6F0137EA9393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE global_permission ADD CONSTRAINT FK_6946B82161220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE global_permission ADD CONSTRAINT FK_6946B8219393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE local_permission ADD CONSTRAINT FK_826AC8FA2534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE local_permission ADD CONSTRAINT FK_826AC8FAEC6D299B FOREIGN KEY (global_permission_id) REFERENCES global_permission (id)');
        $this->addSql('ALTER TABLE partner ADD CONSTRAINT FK_312B3E1661220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EA9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE local_permission DROP FOREIGN KEY FK_826AC8FAEC6D299B');
        $this->addSql('ALTER TABLE global_permission DROP FOREIGN KEY FK_6946B8219393F8FE');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA9393F8FE');
        $this->addSql('ALTER TABLE local_permission DROP FOREIGN KEY FK_826AC8FA2534008B');
        $this->addSql('ALTER TABLE global_permission DROP FOREIGN KEY FK_6946B82161220EA6');
        $this->addSql('ALTER TABLE partner DROP FOREIGN KEY FK_312B3E1661220EA6');
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EA61220EA6');
        $this->addSql('DROP TABLE global_permission');
        $this->addSql('DROP TABLE local_permission');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE `user`');
    }
}
