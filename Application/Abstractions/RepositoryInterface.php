<?php declare(strict_types=1);


namespace Application\Abstractions;


interface RepositoryInterface 
{
    public function getTwoRecords(): array;
}