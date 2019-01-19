<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116163430 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, subject_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(127) NOT NULL, metadata VARCHAR(255) DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, link VARCHAR(511) DEFAULT NULL, file VARCHAR(255) DEFAULT NULL, INDEX IDX_7CBE7595C54C8C93 (type_id), INDEX IDX_7CBE759523EDC87 (subject_id), INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_content (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(127) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX id_idx (identifier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, training_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(127) NOT NULL, subjectcode VARCHAR(127) DEFAULT NULL, semester INT DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, color VARCHAR(31) DEFAULT NULL, INDEX IDX_FBCE3E7ABEFD98D1 (training_id), INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(127) NOT NULL, msc TINYINT(1) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(127) NOT NULL, internaltype INT NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595C54C8C93 FOREIGN KEY (type_id) REFERENCES content_type (id)');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE759523EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7ABEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE759523EDC87');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7ABEFD98D1');
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE7595C54C8C93');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE text_content');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE content_type');
    }
}
