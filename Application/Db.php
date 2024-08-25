<?php declare(strict_types=1);

namespace Application;

use Application\Abstractions\DbInterface;
use Application\Params\DbParams;

final readonly class Db implements DbInterface {
    private \PDO $pdo;
    private \PDOStatement $statement;
    
    private const DB_TEMPLATE = "mysql:dbname=%s;host=%s;port=%d;charset=utf8";

    public function __construct(DbParams $params)
    {

        $tdsn = "mysql:dbname=lemp_stack;host=localhost;port=3306;charset=utf8";

        $this->pdo = new \PDO(
            sprintf(self::DB_TEMPLATE, $params->dbName, $params->dbHost, $params->dbPort), 
            $params->dbUser, 
            $params->dbPassword
        );
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

    public static function build(DbParams $params)
    {
        return new self($params);
    }


}