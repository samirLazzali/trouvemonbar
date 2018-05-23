<?php
namespace User;
class UserRepository
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
        $rows = $this->connection->query('SELECT * FROM "utilisateur"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setPseudo($row->pseudo)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
		->setNom_p($row->nom_p)
		->setNom_v($row->nom_v)
		->setMdp($row->mdp)
                ->setEmail($row->email);

            $users[] = $user;
        }

        return $users;
    }

}
