<?php
namespace User;
class PaysRepository
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
        $rows = $this->connection->query('SELECT * FROM Pays')->fetchAll(\PDO::FETCH_OBJ);
        $payss = [];
        foreach ($rows as $row) {
            $pays = new Pays();
            $pays
                ->setId_p($row->id_p)
                ->setNom_p($row->nom_p)
                ->setCode_p($row->code_p)
		->setDevise($row->devise)
		->setLangue($row->langue)
		->setCapitale($row->capitale)
		->setContinent($row->continent)
                ->setLienwiki_p($row->lienwiki_p);

            $payss[] = $pays;
        }

        return $payss;
    }
}
 
