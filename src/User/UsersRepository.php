<?php
namespace User;


class UsersRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "users"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new Users();
            $anniv = new \DateTimeImmutable($row->birthday) ;
            $user
                ->setPseudo($row->pseudo)
                ->setAdmin($row->admin)
                ->setBirthday($anniv)
                ->setMdp($row->mdp);
            $users[] = $user;
        }

        return $users;
    }

    public function checkdroitsuser($pseudovisiteur)
    {
        $row = $this->connection->query('SELECT admin FROM "users" WHERE pseudo=$pseudovisiteur ') ;
        echo $row ;
        echo "trcuazr";
        if( $row=="t" ){
            $grantdroits = "GRANT ALL PRIVILEGES ON users,manga,chapitre,biblio TO '$pseudovisiteur' WITH GRANT OPTION";
            $this->connection->query($grantdroits) ;
            return $row;
        }
        return $row;
    }

}