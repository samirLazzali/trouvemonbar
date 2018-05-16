<?php

namespace Amis;
class AmisRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MessageRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "amis"')->fetchAll(\PDO::FETCH_OBJ);
        $amis = [];
        foreach ($rows as $row) {
            $ami = new Amis();
            $ami
                ->setId($row->id)
                ->setPersonne1($row->personne1);
                
               
            $amis[] = $ami;
        }

        return $amis;
    }


}
