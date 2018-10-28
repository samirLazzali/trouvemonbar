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

    public function fetchByEmailAndHash(string $email, string $hash)
    {
        $stmt = $this->connection->prepare('SELECT id, email, pseudo, role FROM "user" WHERE UPPER(email) = UPPER(:email) AND hash = :hash');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, \PDO::PARAM_STR);

        if (!$stmt->execute()) return false;

        return $stmt->fetch();
    }

    public function fetchById(int $id)
    {
        $stmt = $this->connection->prepare('SELECT id, email, pseudo FROM "user" WHERE id = :id');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$stmt->execute()) return false;

        $user = $stmt->fetch();
        if (!$user) return false;

        $stmt = $this->connection->prepare('SELECT kw.name FROM "user" u, keyword kw, keyuser ku WHERE u.id = :id AND u.id = ku.idUser AND ku.idKeyWord = kw.id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$stmt->execute()) return false;

        $user->addKeywords($stmt->fetchAll(\PDO::FETCH_COLUMN));
        return $user;
    }

}
