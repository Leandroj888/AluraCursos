<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221103005233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Criação de uma tabela de teste';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql("CREATE TABLE teste2 (id INTEGER PRIMARY KEY, name VARCHAR(255), PRIMARY KEY(id))");

        $table = $schema->createTable("teste");
        $table->addColumn("id", "integer")->setAutoincrement(true);
        $table->addColumn("name", "string");
        $table->setPrimaryKey(["id"]);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql("DROP TABLE teste2");
        $schema->dropTable("teste");

    }
}
