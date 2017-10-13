<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170715201142 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
            ALTER TABLE subscriber
            ADD COLUMN email CHARACTER VARYING(128),
            ADD COLUMN subscribers BIGINT,
            ADD COLUMN subscriptions BIGINT;
SQL
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql(<<<SQL
            ALTER TABLE subscriber
            DROP COLUMN email,
            DROP COLUMN subscribers,
            DROP COLUMN subscriptions;
SQL
        );
    }
}
