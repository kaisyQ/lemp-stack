<?php declare(strict_types=1);

namespace Application\Params;


final readonly class DbParams {
    public function __construct(
        public string $dbName,
        public string $dbHost,
        public int $dbPort,
        public string $dbUser,
        public string $dbPassword
    ){}
}