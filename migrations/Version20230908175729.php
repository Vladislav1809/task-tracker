<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908175729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE client_entity_id_seq CASCADE');
        $this->addSql('ALTER TABLE client_entity_task_entity DROP CONSTRAINT fk_dd21f1786a05ad52');
        $this->addSql('ALTER TABLE client_entity_task_entity DROP CONSTRAINT fk_dd21f178fe0fb00c');
        $this->addSql('DROP TABLE client_entity_task_entity');
        $this->addSql('DROP TABLE client_entity');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE client_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client_entity_task_entity (client_entity_id INT NOT NULL, task_entity_id INT NOT NULL, PRIMARY KEY(client_entity_id, task_entity_id))');
        $this->addSql('CREATE INDEX idx_dd21f178fe0fb00c ON client_entity_task_entity (task_entity_id)');
        $this->addSql('CREATE INDEX idx_dd21f1786a05ad52 ON client_entity_task_entity (client_entity_id)');
        $this->addSql('CREATE TABLE client_entity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE client_entity_task_entity ADD CONSTRAINT fk_dd21f1786a05ad52 FOREIGN KEY (client_entity_id) REFERENCES client_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client_entity_task_entity ADD CONSTRAINT fk_dd21f178fe0fb00c FOREIGN KEY (task_entity_id) REFERENCES task_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
