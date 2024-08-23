<?php declare(strict_types=1);


namespace Application;

use Application\Abstractions\DbInterface;
use Application\Abstractions\RepositoryInterface;

final readonly class Repository implements RepositoryInterface
{
    private DbInterface $db;
    public function __construct(DbInterface $db)
    {
        $this->db = $db;
    }


    public function getTwoRecords(): array 
    {
        return [
            ['id' => 1],
            ['id' => 2]
        ];
    }
}