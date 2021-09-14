<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210914101034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dishes (id INT AUTO_INCREMENT NOT NULL, fk_user_id_id INT DEFAULT NULL, dish_name VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nutrition_facts VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, recipe VARCHAR(255) NOT NULL, type VARCHAR(50) NOT NULL, category VARCHAR(50) NOT NULL, calories INT NOT NULL, dish_status VARCHAR(50) NOT NULL, INDEX IDX_584DD35D6DE8AF9C (fk_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meals (id INT AUTO_INCREMENT NOT NULL, fk_user_id_id INT NOT NULL, fk_dish_id_id INT NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_E229E6EA6DE8AF9C (fk_user_id_id), INDEX IDX_E229E6EAE5107689 (fk_dish_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planner (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, avatar VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D6DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meals ADD CONSTRAINT FK_E229E6EA6DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meals ADD CONSTRAINT FK_E229E6EAE5107689 FOREIGN KEY (fk_dish_id_id) REFERENCES dishes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EAE5107689');
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D6DE8AF9C');
        $this->addSql('ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EA6DE8AF9C');
        $this->addSql('DROP TABLE dishes');
        $this->addSql('DROP TABLE meals');
        $this->addSql('DROP TABLE planner');
        $this->addSql('DROP TABLE user');
    }
}
