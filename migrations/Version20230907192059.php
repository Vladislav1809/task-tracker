<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907192059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE client_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client_entity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE client_entity_task_entity (client_entity_id INT NOT NULL, task_entity_id INT NOT NULL, PRIMARY KEY(client_entity_id, task_entity_id))');
        $this->addSql('CREATE INDEX IDX_DD21F1786A05AD52 ON client_entity_task_entity (client_entity_id)');
        $this->addSql('CREATE INDEX IDX_DD21F178FE0FB00C ON client_entity_task_entity (task_entity_id)');
        $this->addSql('ALTER TABLE client_entity_task_entity ADD CONSTRAINT FK_DD21F1786A05AD52 FOREIGN KEY (client_entity_id) REFERENCES client_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_entity_task_entity ADD CONSTRAINT FK_DD21F178FE0FB00C FOREIGN KEY (task_entity_id) REFERENCES task_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE client_entity_id_seq CASCADE');
        $this->addSql('ALTER TABLE client_entity_task_entity DROP CONSTRAINT FK_DD21F1786A05AD52');
        $this->addSql('ALTER TABLE client_entity_task_entity DROP CONSTRAINT FK_DD21F178FE0FB00C');
        $this->addSql('DROP TABLE client_entity');
        $this->addSql('DROP TABLE client_entity_task_entity');
    }
}
