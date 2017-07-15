<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170715203049 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $handle = fopen(__DIR__ . '/content/info_subscribers', 'r');

        while (($line = fgets($handle)) !== false) {
            $name = trim($line);

            $this->addSql(
                strtr("
                    INSERT INTO subscriber (name, link, status, is_on_platform) 
                    SELECT * FROM (SELECT '{name}', '{link}', 'ready', false) AS tmp
                    WHERE NOT EXISTS (
                        SELECT name FROM subscriber WHERE name = '{name}'
                    ) LIMIT 1;
                    ",
                    [
                        '{name}' => $name,
                        '{link}' => 'https://www.instagram.com/' . $name,
                    ]
                )

            );
        }

        fclose($handle);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        /*_*/
    }
}
