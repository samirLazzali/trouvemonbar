<?php
namespace Keyword;

class KeywordRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $stmt = $this->connection->query('SELECT id, name FROM keyword');
        if (!$stmt) {
            return false;
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Keyword::class);
    }
}
