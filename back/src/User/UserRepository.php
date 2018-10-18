<?php
namespace User;

class UserRepository
{
    private $connection;
    private $userHydrator;

    public function __construct($connection, UserHydrator $userHydrator)
    {
        $this->connection = $connection;
        $this->userHydrator = $userHydrator;
    }

    public function fetchAll()
    {
        $rows = $this->connection
            ->query('SELECT * FROM "user"')
            ->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->userHydrator->hydrate($row);
        }

        return $users;
    }

}
