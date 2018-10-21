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
        $myClass = new Bar();
        $request = $this->connection->prepare('SELECT * FROM "bar" where id=?');
        // $request = $request->bindValue(':id',$id, PDO::PARAM_INT);
        // $request->execute();
        $request->setFetchMode(\PDO::FETCH_INTO, $myClass);
        $request->execute([$id]);
        return $myClass;
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
