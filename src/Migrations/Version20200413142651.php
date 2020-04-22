<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413142651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD typ_numero_id INT NOT NULL, ADD palier_id INT NOT NULL, ADD societe VARCHAR(255) NOT NULL, ADD siren VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD cp INT NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD phone INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C1F95A15 FOREIGN KEY (typ_numero_id) REFERENCES type_numero (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64960E28355 FOREIGN KEY (palier_id) REFERENCES palier (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C1F95A15 ON user (typ_numero_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64960E28355 ON user (palier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C1F95A15');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64960E28355');
        $this->addSql('DROP INDEX IDX_8D93D649C1F95A15 ON user');
        $this->addSql('DROP INDEX IDX_8D93D64960E28355 ON user');
        $this->addSql('ALTER TABLE user DROP typ_numero_id, DROP palier_id, DROP societe, DROP siren, DROP adresse, DROP cp, DROP ville, DROP phone');
    }
}
