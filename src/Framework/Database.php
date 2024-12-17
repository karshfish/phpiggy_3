<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{
    public PDO $connection;
    public PDOStatement $stmt;
    public function __construct(string $driver, array $config, string $username, string $password)
    {

        $config = http_build_query(
            data: $config,
            arg_separator: ";"
        );
        $dsn = "{$driver}:{$config}";


        try {
            $this->connection = new PDO(dsn: $dsn, username: $username,  password: $password);
        } catch (PDOException $e) {
            die("Unable to Connect to database ");
        }
    }
    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }
    public function count()
    {
        return $this->stmt->fetchColumn();
    }
}
