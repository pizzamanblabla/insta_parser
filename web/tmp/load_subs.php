<?php

if ($handle = opendir('content')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "$entry\n";
        }
    }

    closedir($handle);
}

$pdo = new PDO("pgsql:dbname=insta_parser;host=127.0.0.1;port=5435;", 'postgres', 'root');

while (($line = fgets($handle)) !== false) {

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
		}

	} catch (Throwable $e) {
		continue;
	}
}

fclose($handle);
