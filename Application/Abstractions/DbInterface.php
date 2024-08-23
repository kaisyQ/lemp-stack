<?php declare(strict_types=1);

namespace Application\Abstractions;


interface DbInterface 
{
    public function prepare(string $sql): self;

    public function execute(array $params): self;

    public function fetchAll(): array;
}
