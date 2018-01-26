<?php

$pdo = new PDO("pgsql:dbname=insta_parser;host=instaparser-postgresql;port=5432;", 'postgres', 'postgres');

if ($handle = opendir(__DIR__ . '/content')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $fileHandle = fopen(__DIR__ . '/content/' . $entry, 'r');

            while (($line = fgets($fileHandle)) !== false) {

                try {
                    $name = trim($line);

                    if (!empty($name)) {
                        $query = strtr("
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
                        );

                        $pdo->exec($query);
                        $id = $pdo->lastInsertId();

                        $query = "SELECT id FROM tag WHERE type='" . $entry . "' LIMIT 1;";
                        $tagId = $pdo->query($query, PDO::FETCH_ASSOC);

                        $query = strtr("
                    INSERT INTO subscriber_tag (subscriber_id, tag_id) VALUES ({subscriber_id}, {tag_id});
                    ",
                            [
                                '{subscriber_id}' => $id,
                                '{tag_id}' => $tagId->fetchColumn(),
                            ]
                        );

                        $pdo->exec($query);

                    }

                } catch (Throwable $e) {
                    continue;
                }
            }

            fclose($fileHandle);
            unlink(__DIR__ . '/content/' . $entry);
        }
    }

    closedir($handle);
}
