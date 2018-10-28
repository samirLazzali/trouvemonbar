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
            $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw WHERE kb.idBar=b.id AND kw.id=kb.idKeyWord AND b.id=:id');
            $request->bindParam(':id',$id, \PDO::PARAM_INT);
            $request->execute();
            if(!$execute){
                return false;
            }
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
        $request = $this->connection->prepare('SELECT * FROM "bar" WHERE id = :id');
        $request->setFetchMode(\PDO::FETCH_CLASS, Bar::class);
        $request->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $bar = $request->fetch();
        if (!$bar) return null;

        $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw WHERE kb.idBar=b.id AND kw.id=kb.idKeyWord AND b.id=:id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        if ($request->execute()) $bar->addKeywords($request->fetchAll(\PDO::FETCH_COLUMN));

        return $bar;
    }

    public function bindKeyWordWithBar($id)
    {
        $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw WHERE kb.idBar=b.id AND kw.id=kb.idKeyWord AND b.id=:id' );
        $request->bindParam(':id',$id, \PDO::PARAM_INT);

        if (!$request->execute()) return false;

        $keywords = $request->fetchAll(\PDO::FETCH_COLUMN);

        if(count($keywords) > 0) {
            return $keywords;
        } else {
            return false;
        }
    }

    public function compareByID($A,$B)
    {
        $idA = $A->getId();
        $idB = $B->getId();

        if ($idA === $idB) return 0;

        return $idA > $idB ? 1 : -1;
    }

    public function fetchByKeyWords($keywords)
    {
        $results = [];
        $bars = [];

        $request = $this->connection->prepare('select b.* from bar as b join keybar as kb on b.id=kb.idbar join keyword as kw on kw.id=kb.idkeyword WHERE UPPER(kw.name)=UPPER(:kw) ');
        $request->bindParam(':kw',array_values($keywords)[0], \PDO::PARAM_STR);
        $request->execute();
        $results =  $request->fetchAll(\PDO::FETCH_CLASS, Bar::CLASS);
        array_shift($keywords);
        if(count($keywords)==0){
            $bars=$results;
        }
        foreach($keywords as $keyword){
            $tmp = [];

            $request->bindParam(':kw',$keyword, \PDO::PARAM_STR);
            $request->execute();
            while($row = $request->fetchAll(\PDO::FETCH_CLASS,Bar::CLASS))
                $tmp = $row;
            $bars=array_uintersect($tmp,$results,[$this,'compareByID']);
            $results=$tmp;
        }

        foreach($bars as $bar)
        {
            $keywords=$this->bindKeyWordWithBar($bar->getId());
            if($keywords!=false)
            {
                $bar->addKeywords($keywords);
            }
        }
        return$bars;
    }
}
