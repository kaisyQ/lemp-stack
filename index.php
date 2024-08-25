<?php declare(strict_types=1);

require_once __DIR__ . "/Application/bootstrap.php";


$list = $repository->getTwoRecords();

$html = "<ul>" . implode("<br>", array_map(static fn ($row): string  => $row['name'], $list)) . "</ul>";

echo $html;