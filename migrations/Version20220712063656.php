<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712063656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, customer VARCHAR(100) NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, price NUMERIC(10, 2) NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Asem', '2022-08-05', '2022-08-10')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Asem', '2022-08-13', '2022-08-16')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Mark', '2022-08-03', '2022-08-07')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Kevin', '2022-08-12', '2022-08-18')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('David', '2022-08-17', '2022-08-25')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Tom', '2022-08-06', '2022-08-07')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Asem', '2022-08-22', '2022-08-28')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('George', '2022-08-07', '2022-08-07')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('James', '2022-08-06', '2022-08-08')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Robert', '2022-08-07', '2022-08-09')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('James', '2022-08-10', '2022-08-10')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Richard', '2022-08-07', '2022-08-10')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Daniel', '2022-08-03', '2022-08-08')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Steven', '2022-08-02', '2022-08-08')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Steven', '2022-08-12', '2022-08-14')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Haya', '2022-08-02', '2022-08-04')");
        $this->addSql("INSERT INTO `booking` (`customer`, `date_from`, `date_to`) VALUES ('Sarah', '2022-08-03', '2022-08-10')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
