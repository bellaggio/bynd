<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026190850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('book');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255]);
        $table->addColumn('author_id', 'integer');
        $table->addColumn('publisher_id', 'integer');
        $table->addColumn('description', 'text');
        $table->addColumn('isbn', 'integer');
        $table->setPrimaryKey(['id']);
        $table->addForeignKeyConstraint('author', ['author_id'], ['id'], ['onDelete' => 'CASCADE']);
        $table->addForeignKeyConstraint('publisher', ['publisher_id'], ['id'], ['onDelete' => 'CASCADE']);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('book');
    }
}
