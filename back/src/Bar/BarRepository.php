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
        $bars = $this->connection
            ->query('SELECT * FROM "bar"')
            ->fetchAll(\PDO::FETCH_CLASS, Bar::class);
        foreach ($bars as $bar) {
            $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "idKeyWord" kw where kb.idBar=b.id AND kw.id=kb.idKeyWord AND b.id=:id');
            $request->bindParam(':id',$bar->getId(), \PDO::PARAM_INT);
            $request->execute();
            $keywords = $request->fetchAll(\PDO::FETCH_COLUMN);
            if(count($keywords) > 0)
            {
                $bar->addKeywords($keywords);
            }
        }
        return $bars;
    }

    public function fetchById($id)
    {
        $request = $this->connection->prepare('SELECT * FROM "bar" where id=:id');
        $request->bindParam(':id',$id, \PDO::PARAM_INT);
        $request->execute();
        $bars = $request->fetchAll(\PDO::FETCH_CLASS, Bar::class);
        if(count($bars) > 0)
        {
            // Get the first bar
            $bar = $bars[0];
            $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "idKeyWord" kw where kb.idBar=b.id AND kw.id=kb.idKeyWord AND b.id=:id');
            $request->bindParam(':id',$id, \PDO::PARAM_INT);
            $request->execute();
            $keywords = $request->fetchAll(\PDO::FETCH_COLUMN);
            if(count($keywords) > 0)
            {
                $bar->addKeywords($keywords);
            }
            return $bar;
            
            
        }
        else
        {
            return NULL;
        }
    }

}
