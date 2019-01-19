<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190118223437 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX id_idx ON text_content');
        $this->addSql('CREATE UNIQUE INDEX id_idx ON text_content (identifier)');
        $this->addSql('DROP INDEX slug_idx ON subject');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON subject (slug)');
        $this->addSql('DROP INDEX slug_idx ON training');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON training (slug)');
        $this->addSql('DROP INDEX slug_idx ON content_type');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON content_type (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX slug_idx ON content_type');
        $this->addSql('CREATE INDEX slug_idx ON content_type (slug)');
        $this->addSql('DROP INDEX slug_idx ON subject');
        $this->addSql('CREATE INDEX slug_idx ON subject (slug)');
        $this->addSql('DROP INDEX id_idx ON text_content');
        $this->addSql('CREATE INDEX id_idx ON text_content (identifier)');
        $this->addSql('DROP INDEX slug_idx ON training');
        $this->addSql('CREATE INDEX slug_idx ON training (slug)');
    }
}
