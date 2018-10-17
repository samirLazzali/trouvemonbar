<?php
namespace User;

class UserRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    private $userHydrator;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection, UserHydrator $userHydrator)
    {
        $this->connection = $connection;
        $this->userHydrator = $userHydrator;
    }

    public function fetchAll()
    {
        $rows = $this
            ->connection->query('SELECT * FROM "user"')
            ->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->userHydrator->hydrate($row);
        }

        return $users;
    }


}
