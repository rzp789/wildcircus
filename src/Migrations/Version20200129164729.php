<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129164729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shows (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, date DATETIME DEFAULT NULL, title VARCHAR(30) NOT NULL, description LONGTEXT NOT NULL, departement VARCHAR(30) NOT NULL, price INT DEFAULT NULL, projectlaunch TINYINT(1) NOT NULL, picture LONGTEXT DEFAULT NULL, nbspectator INT DEFAULT NULL, checkspectator TINYINT(1) NOT NULL, INDEX IDX_6C3BF144783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE show_user (show_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5164008AD0C1FC64 (show_id), INDEX IDX_5164008AA76ED395 (user_id), PRIMARY KEY(show_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, nickname VARCHAR(20) NOT NULL, personaldescription LONGTEXT NOT NULL, video LONGTEXT DEFAULT NULL, avatar LONGTEXT NOT NULL, categoryactivity VARCHAR(20) NOT NULL, ownactivity VARCHAR(40) NOT NULL, descriptionownactivity LONGTEXT NOT NULL, picture LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spectator (id INT AUTO_INCREMENT NOT NULL, spectacle_id INT NOT NULL, email VARCHAR(180) NOT NULL, interestrate INT NOT NULL, INDEX IDX_54C71505C682915D (spectacle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shows ADD CONSTRAINT FK_6C3BF144783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE show_user ADD CONSTRAINT FK_5164008AD0C1FC64 FOREIGN KEY (show_id) REFERENCES shows (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE show_user ADD CONSTRAINT FK_5164008AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spectator ADD CONSTRAINT FK_54C71505C682915D FOREIGN KEY (spectacle_id) REFERENCES shows (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE show_user DROP FOREIGN KEY FK_5164008AD0C1FC64');
        $this->addSql('ALTER TABLE spectator DROP FOREIGN KEY FK_54C71505C682915D');
        $this->addSql('ALTER TABLE shows DROP FOREIGN KEY FK_6C3BF144783E3463');
        $this->addSql('ALTER TABLE show_user DROP FOREIGN KEY FK_5164008AA76ED395');
        $this->addSql('DROP TABLE shows');
        $this->addSql('DROP TABLE show_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE spectator');
    }
}
