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

    public function fetchByEmailAndHash(string $email, string $hash)
    {
        $stmt = $this->connection->prepare('SELECT id, email, pseudo, role FROM "user" WHERE email = :email AND hash = :hash');
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, \PDO::PARAM_STR);

        if (!$stmt->execute()) return false;

        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $stmt->fetch();
    }

}
