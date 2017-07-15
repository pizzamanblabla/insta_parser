<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170528193355 extends AbstractMigration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
            CREATE TABLE brand(
                id SERIAL NOT NULL PRIMARY KEY,
                name CHARACTER VARYING(128) NOT NULL
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE UNIQUE INDEX brand_name_idx ON brand (name);
SQL
        );

        $this->addSql(<<<SQL
            CREATE TABLE mention(
                id SERIAL NOT NULL PRIMARY KEY,
                subscriber_id INTEGER NOT NULL,
                brand_id INTEGER NOT NULL,
                date TIMESTAMPTZ NOT NULL DEFAULT current_timestamp
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE INDEX mention_date_idx ON mention (date);
SQL
        );

        $this->addSql(<<<SQL
            CREATE UNIQUE INDEX mention_unique_idx ON mention (date, subscriber_id, brand_id);
SQL
        );

        $this->addSql(<<<SQL
            CREATE TABLE subscriber(
                id SERIAL NOT NULL PRIMARY KEY,
                name CHARACTER VARYING(128) NOT NULL,
                link CHARACTER VARYING(256) NOT NULL,
                status VARCHAR(16) NOT NULL DEFAULT 'ready',
                is_on_platform BOOL DEFAULT FALSE,
                updated_at TIMESTAMPTZ NOT NULL DEFAULT current_timestamp
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE UNIQUE INDEX subscriber_name_unique_idx ON subscriber (name);
SQL
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('brand');
        $schema->dropTable('mention');
        $schema->dropTable('subscriber');
    }
}
