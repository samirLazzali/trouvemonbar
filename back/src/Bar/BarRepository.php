<?php
namespace Bar;

class BarRepository
{
    private $connection;
    private $BarHydrator;

    public function __construct($connection, BarHydrator $BarHydrator)
    {
        $this->connection = $connection;
        $this->BarHydrator = $BarHydrator;
    }

    public function fetchAll()
    {
        $Bars = $this->connection
            ->query('SELECT * FROM "bar"')
            ->fetchAll(\PDO::FETCH_CLASS, Bar::class);

        return $Bars;
    }

    public function fetchById($id)
    {
        // Return False if an error occured
        $request = $this->connection->query('SELECT * FROM "bar" where id=1');
        // $request = $request->bindValue(':id',$id, PDO::PARAM_INT);
        // $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS, Bar::class);
        $bar = $request->fetch();
        return $bar;
        // if(count($bars)>0)
        // {
        //     return $bars[0];
        // }
        // else
        // {
        //     return False;
        // }
    }

}
