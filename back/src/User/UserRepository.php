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
        $users = $this->connection
            ->query('SELECT * FROM "user"')
            ->fetchAll(\PDO::FETCH_CLASS, User::class);

        return $users;
    }

}
