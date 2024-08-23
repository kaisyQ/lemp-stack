<?php declare(strict_types=1);

namespace Application;

use Application\Abstractions\DbInterface;

final readonly class Db implements DbInterface {
    private \PDO $pdo;
    private \PDOStatement $statement;
    public function __construct(string $dsn, string $username, string $password)
    {
        // $this->pdo = new \PDO($dsn, $username, $password);
    }


    public function prepare(string $sql): self
    {
        $this->statement = $this->pdo->prepare($sql);

        return $this;
    }

    public function execute(array $params): self 
    {
        if ($this->statement === null) {
            throw new \Exception("Statement cannot be null");
        }

        $result = $this->statement->execute($params);

        if ($result === false) {
            throw new \Exception("Execute statement error");
        }


        return $this;
    }


    public function fetchAll(): array
    {
        if ($this->statement === null) {
            throw new \Exception("Statement cannot be null");
        }

        $result = $this->statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public static function build(string $dsn, string $username, string $password)
    {
        return new self($dsn, $username, $password);
    }


}