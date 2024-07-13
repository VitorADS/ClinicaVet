<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240707212040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clinica.papel (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, periodo_inicial DATE NOT NULL, periodo_final DATE NOT NULL, ativo BOOLEAN DEFAULT true NOT NULL, roles JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE papel_profissional (papel_id INT NOT NULL, profissional_id INT NOT NULL, PRIMARY KEY(papel_id, profissional_id))');
        $this->addSql('CREATE INDEX IDX_E3F2D3F356B3A8CD ON papel_profissional (papel_id)');
        $this->addSql('CREATE INDEX IDX_E3F2D3F37ADE2C4 ON papel_profissional (profissional_id)');
        $this->addSql('ALTER TABLE papel_profissional ADD CONSTRAINT FK_E3F2D3F356B3A8CD FOREIGN KEY (papel_id) REFERENCES clinica.papel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE papel_profissional ADD CONSTRAINT FK_E3F2D3F37ADE2C4 FOREIGN KEY (profissional_id) REFERENCES clinica.profissional (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE papel_profissional DROP CONSTRAINT FK_E3F2D3F356B3A8CD');
        $this->addSql('ALTER TABLE papel_profissional DROP CONSTRAINT FK_E3F2D3F37ADE2C4');
        $this->addSql('DROP TABLE clinica.papel');
        $this->addSql('DROP TABLE papel_profissional');
    }
}
