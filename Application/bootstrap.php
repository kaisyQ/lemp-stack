<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Application\Abstractions\DbInterface ;
use Application\Abstractions\RepositoryInterface;
use Application\Db;
use Application\Repository;

// all class instances

/** @var DbInterface $db */
$db = new Db("", "", "");

/** @var RepositoryInterface $repository */
$repository = new Repository($db);

