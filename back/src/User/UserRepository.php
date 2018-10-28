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
        $stmt = $this->connection->prepare('SELECT id, email, pseudo, role FROM "user" WHERE UPPER(email) = UPPER(:email) AND hash = :hash');
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, \PDO::PARAM_STR);

        if (!$stmt->execute()) return false;

        $stmt->setFetchMode(\PDO::FETCH_CLASS, User::class);
        return $stmt->fetch();
    }

    public function signupUser($user)
    {
        // Avoid warning passed as reference
        $pseudo = $user->getPseudo();
        $email = $user->getEmail();
        $hash = $user->getHash();
        $role = $user->getRole();

        $stmt = $this->connection->prepare('INSERT INTO "user"(pseudo, email, hash, role) VALUES (:pseudo, :email, :hash, :role)');
        $stmt->bindParam(':pseudo', $pseudo, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, \PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Return FALSE if it doesnt exist otherwise it returns TRUE
    public function pseudoChecker($pseudo)
    {
        if(!isset($pseudo)){
            return TRUE;
        }
        $stmt = $this->connection->prepare('SELECT count(*) from "user" WHERE pseudo=:pseudo');
        $stmt->bindParam(':pseudo', $pseudo, \PDO::PARAM_STR);
        if(!$stmt->execute()) return TRUE;
        if($stmt->fetchColumn() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    // Return FALSE if it doesnt exist otherwise it returns TRUE
    public function emailChecker($email)
    {
        // WHAT DO I DO since it's a boolean function
        if(!isset($email)){
            return TRUE;
        }
        $stmt = $this->connection->prepare('SELECT count(*) from "user" WHERE email=:email');
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        if(!$stmt->execute()) return TRUE;
        if($stmt->fetchColumn() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
}
