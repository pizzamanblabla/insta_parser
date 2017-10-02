<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170930002342 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(<<<SQL
            CREATE TABLE hashtag(
                id SERIAL NOT NULL PRIMARY KEY,
                name CHARACTER VARYING(128) NOT NULL
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE INDEX hashtag_name_idx ON hashtag (name);
SQL
        );

        $this->addSql(<<<SQL
            CREATE TABLE post(
                id SERIAL NOT NULL PRIMARY KEY,
                code CHARACTER VARYING(128) NOT NULL,
                link CHARACTER VARYING(256) NOT NULL,
                subscriber_id INTEGER NOT NULL,
                location_id INTEGER NOT NULL,
                date TIMESTAMPTZ NOT NULL DEFAULT current_timestamp
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE INDEX post_code_idx ON post (code);
SQL
        );

        $this->addSql(<<<SQL
            CREATE TABLE post_hashtag(
                post_id INTEGER NOT NULL,
                hashtag_id INTEGER NOT NULL
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE INDEX post_hashtag_idx ON post_hashtag (post_id, hashtag_id);
SQL
        );

        $this->addSql(<<<SQL
            CREATE TABLE location(
                id SERIAL NOT NULL PRIMARY KEY,
                name CHARACTER VARYING(128) NOT NULL,
                lat FLOAT NOT NULL,
                long FLOAT NOT NULL
            );
SQL
        );

        $this->addSql(<<<SQL
            CREATE INDEX location_coords_idx ON location (lat,long);
SQL
        );

        $this->addSql(<<<SQL
            ALTER TABLE mention ADD COLUMN post_id INTEGER NOT NULL DEFAULT 0;
SQL
        );

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('hashtag');
        $schema->dropTable('post');
        $schema->dropTable('location');
        $schema->dropTable('post_hashtag');

        $this->addSql(<<<SQL
            ALTER TABLE mention DROP COLUMN post_id;
SQL
        );
    }
}
