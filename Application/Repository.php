<?php declare(strict_types=1);


namespace Application;

use Application\Abstractions\DbInterface;
use Application\Abstractions\RepositoryInterface;

final readonly class Repository implements RepositoryInterface
{
    public function __construct(
        private DbInterface $db
    ){}

    public function getTwoRecords(): array 
    {

        $sql = 'select l.name from  lemp_stack.test as l limit 2';

        $result = $this->db
            ->prepare($sql)
            ->execute([])
            ->fetchAll();

        return $result;
    }
}