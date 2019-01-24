<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190124205356 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX slug_idx ON subject');
        $this->addSql('CREATE INDEX slug_idx ON subject (slug)');
        $this->addSql('DROP INDEX slug_idx ON training');
        $this->addSql('CREATE INDEX slug_idx ON training (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX slug_idx ON subject');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON subject (slug)');
        $this->addSql('DROP INDEX slug_idx ON training');
        $this->addSql('CREATE UNIQUE INDEX slug_idx ON training (slug)');
    }
}
