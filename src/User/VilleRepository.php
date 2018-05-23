<?php
namespace User;
class VilleRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * VilleRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM Ville')->fetchAll(\PDO::FETCH_OBJ);
        $villes = [];
        foreach ($rows as $row) {
            $ville = new Ville();
            $ville
                ->setId_v($row->id_v)
                ->setNom_v($row->nom_v)
                ->setPopulation($row->population)
		->setNom_p($row->nom_p)
		->setSuperficie($row->superficie)
                ->setLienwiki_v($row->lienwiki_v);

            $villes[] = $ville;
        }

        return $villes;
    }

}
