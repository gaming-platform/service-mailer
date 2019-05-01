<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Persistence\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190429195706 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('template');

        $table->addColumn('id', 'uuid_binary_ordered_time');
        $table->addColumn('name', 'string');
        $table->addColumn('sender_email', 'string');
        $table->addColumn('sender_name', 'string');
        $table->addColumn('subject_template', 'text');
        $table->addColumn('html_template', 'text');
        $table->addColumn('text_template', 'text');
        $table->addColumn('created_at', 'datetime_immutable');

        $table->addUniqueIndex(['name', 'created_at'], 'uniq_template_name_created_at');

        $table->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $schema->dropTable('template');
    }
}
