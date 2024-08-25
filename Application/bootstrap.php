<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Application\Abstractions\DbInterface ;
use Application\Abstractions\RepositoryInterface;
use Application\Db;
use Application\Params\DbParams;
use Application\Repository;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// all class instances


$dbParams = new DbParams(
    $_ENV['DB_NAME'],
    $_ENV['DB_HOST'],
    (int)$_ENV['DB_PORT'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']
);


/** @var DbInterface $db */
$db = new Db($dbParams);

/** @var RepositoryInterface $repository */
$repository = new Repository($db);

