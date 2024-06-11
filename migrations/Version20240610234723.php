<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610234723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            insert into clinica.pagamento (pagamento) values
            ('Dinheiro'),
            ('Credito'),
            ('Debito'),
            ('Pix');
        ");

        $this->addSql("
            insert into clinica.status_atendimento (status) values
            ('Novo'),
            ('Em atendimento'),
            ('Finalizado');
        ");

        $this->addSql("
            insert into clinica.tipo (tipo) values
            ('Pequeno'),
            ('Medio'),
            ('Grande');
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("
            delete from clinica.pagamento;
        ");

        $this->addSql("
            delete from clinica.status_atendimento;
        ");

        $this->addSql("
            delete from clinica.tipo;
        ");
    }
}
