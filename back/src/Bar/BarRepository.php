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
            $id = $bar->getId();
            $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw where kb.idBar=b.id AND kw.id=kb.idKeyWord and kb.nboccurence>0 and b.id=:id');
            $request->bindParam(':id',$id, \PDO::PARAM_INT);
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
            $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw where kb.idBar=b.id AND kw.id=kb.idKeyWord AND b.id=:id');
            $request->bindParam(':id',$id, \PDO::PARAM_INT);
            $request->execute();
            $keywords = $request->fetchAll(\PDO::FETCH_COLUMN);
            if(count($keywords) > 0)
            {
                $bar->addKeywords($keywords);
            }
            return $bar;
            //

        }
        else
        {
            return NULL;
        }
    }

    public function fetchByKeyWords($keywords){
        if(count($keywords)>0){
            foreach($keywords as $keyword){
                $request = $this->connection->prepare('select b.name from bar as b join keybar as kb on b.id=kb.idbar join keyword as kw on kw.id=kb.idkeyword where kw.name=:kw ');
                $request->bindParam(':kw',$keyword, \PDO::PARAM_STR);

            $request->execute();
            $bars= $request->fetchAll(\PDO::FETCH_CLASS, Bar::CLASS);
            }


        }

        return $bars;

    }

}
