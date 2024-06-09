<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608214335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA clinica');
        $this->addSql('CREATE TABLE clinica.animal (id SERIAL NOT NULL, tipo INT NOT NULL, raca INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, cor VARCHAR(255) NOT NULL, peso DOUBLE PRECISION NOT NULL, altura DOUBLE PRECISION NOT NULL, data_nascimento DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12A1A9B4702D1D47 ON clinica.animal (tipo)');
        $this->addSql('CREATE INDEX IDX_12A1A9B4DD027FB6 ON clinica.animal (raca)');
        $this->addSql('CREATE TABLE clinica.atendimento (id SERIAL NOT NULL, animal INT NOT NULL, clinica INT NOT NULL, profissional_clinica INT NOT NULL, status_atendimento INT NOT NULL, pagamento INT DEFAULT NULL, observacoes VARCHAR(255) DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, data TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50C781DC6AAB231F ON clinica.atendimento (animal)');
        $this->addSql('CREATE INDEX IDX_50C781DC24BC4A2E ON clinica.atendimento (clinica)');
        $this->addSql('CREATE INDEX IDX_50C781DCCBBB96B ON clinica.atendimento (profissional_clinica)');
        $this->addSql('CREATE INDEX IDX_50C781DC3B7F7ADD ON clinica.atendimento (status_atendimento)');
        $this->addSql('CREATE INDEX IDX_50C781DC3E1F4B16 ON clinica.atendimento (pagamento)');
        $this->addSql('CREATE TABLE clinica.atendimento_vacina (id SERIAL NOT NULL, atendimento INT NOT NULL, vacina INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B731DC813FA50F2C ON clinica.atendimento_vacina (atendimento)');
        $this->addSql('CREATE INDEX IDX_B731DC8167B5AE27 ON clinica.atendimento_vacina (vacina)');
        $this->addSql('CREATE TABLE clinica.clinica (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.pagamento (id SERIAL NOT NULL, pagamento VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.profissional (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, telefone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.profissional_clinica (id SERIAL NOT NULL, clinica INT NOT NULL, profissional INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_39770D5A24BC4A2E ON clinica.profissional_clinica (clinica)');
        $this->addSql('CREATE INDEX IDX_39770D5AE41A66E5 ON clinica.profissional_clinica (profissional)');
        $this->addSql('CREATE TABLE clinica.raca (id SERIAL NOT NULL, raca VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.responsavel (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telefone VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.responsavel_animal (id SERIAL NOT NULL, animal INT NOT NULL, responsavel INT NOT NULL, padrao BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_94ACB2A56AAB231F ON clinica.responsavel_animal (animal)');
        $this->addSql('CREATE INDEX IDX_94ACB2A5E1630546 ON clinica.responsavel_animal (responsavel)');
        $this->addSql('CREATE TABLE clinica.status_atendimento (id SERIAL NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.tipo (id SERIAL NOT NULL, tipo VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE clinica.vacina (id SERIAL NOT NULL, nome VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE clinica.animal ADD CONSTRAINT FK_12A1A9B4702D1D47 FOREIGN KEY (tipo) REFERENCES clinica.tipo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.animal ADD CONSTRAINT FK_12A1A9B4DD027FB6 FOREIGN KEY (raca) REFERENCES clinica.raca (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento ADD CONSTRAINT FK_50C781DC6AAB231F FOREIGN KEY (animal) REFERENCES clinica.animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento ADD CONSTRAINT FK_50C781DC24BC4A2E FOREIGN KEY (clinica) REFERENCES clinica.clinica (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento ADD CONSTRAINT FK_50C781DCCBBB96B FOREIGN KEY (profissional_clinica) REFERENCES clinica.profissional_clinica (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento ADD CONSTRAINT FK_50C781DC3B7F7ADD FOREIGN KEY (status_atendimento) REFERENCES clinica.status_atendimento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento ADD CONSTRAINT FK_50C781DC3E1F4B16 FOREIGN KEY (pagamento) REFERENCES clinica.pagamento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento_vacina ADD CONSTRAINT FK_B731DC813FA50F2C FOREIGN KEY (atendimento) REFERENCES clinica.atendimento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.atendimento_vacina ADD CONSTRAINT FK_B731DC8167B5AE27 FOREIGN KEY (vacina) REFERENCES clinica.vacina (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.profissional_clinica ADD CONSTRAINT FK_39770D5A24BC4A2E FOREIGN KEY (clinica) REFERENCES clinica.clinica (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.profissional_clinica ADD CONSTRAINT FK_39770D5AE41A66E5 FOREIGN KEY (profissional) REFERENCES clinica.profissional (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.responsavel_animal ADD CONSTRAINT FK_94ACB2A56AAB231F FOREIGN KEY (animal) REFERENCES clinica.animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE clinica.responsavel_animal ADD CONSTRAINT FK_94ACB2A5E1630546 FOREIGN KEY (responsavel) REFERENCES clinica.responsavel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clinica.animal DROP CONSTRAINT FK_12A1A9B4702D1D47');
        $this->addSql('ALTER TABLE clinica.animal DROP CONSTRAINT FK_12A1A9B4DD027FB6');
        $this->addSql('ALTER TABLE clinica.atendimento DROP CONSTRAINT FK_50C781DC6AAB231F');
        $this->addSql('ALTER TABLE clinica.atendimento DROP CONSTRAINT FK_50C781DC24BC4A2E');
        $this->addSql('ALTER TABLE clinica.atendimento DROP CONSTRAINT FK_50C781DCCBBB96B');
        $this->addSql('ALTER TABLE clinica.atendimento DROP CONSTRAINT FK_50C781DC3B7F7ADD');
        $this->addSql('ALTER TABLE clinica.atendimento DROP CONSTRAINT FK_50C781DC3E1F4B16');
        $this->addSql('ALTER TABLE clinica.atendimento_vacina DROP CONSTRAINT FK_B731DC813FA50F2C');
        $this->addSql('ALTER TABLE clinica.atendimento_vacina DROP CONSTRAINT FK_B731DC8167B5AE27');
        $this->addSql('ALTER TABLE clinica.profissional_clinica DROP CONSTRAINT FK_39770D5A24BC4A2E');
        $this->addSql('ALTER TABLE clinica.profissional_clinica DROP CONSTRAINT FK_39770D5AE41A66E5');
        $this->addSql('ALTER TABLE clinica.responsavel_animal DROP CONSTRAINT FK_94ACB2A56AAB231F');
        $this->addSql('ALTER TABLE clinica.responsavel_animal DROP CONSTRAINT FK_94ACB2A5E1630546');
        $this->addSql('DROP TABLE clinica.animal');
        $this->addSql('DROP TABLE clinica.atendimento');
        $this->addSql('DROP TABLE clinica.atendimento_vacina');
        $this->addSql('DROP TABLE clinica.clinica');
        $this->addSql('DROP TABLE clinica.pagamento');
        $this->addSql('DROP TABLE clinica.profissional');
        $this->addSql('DROP TABLE clinica.profissional_clinica');
        $this->addSql('DROP TABLE clinica.raca');
        $this->addSql('DROP TABLE clinica.responsavel');
        $this->addSql('DROP TABLE clinica.responsavel_animal');
        $this->addSql('DROP TABLE clinica.status_atendimento');
        $this->addSql('DROP TABLE clinica.tipo');
        $this->addSql('DROP TABLE clinica.vacina');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
