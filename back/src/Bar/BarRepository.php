<?php
namespace Bar;

class BarRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function fetchById($id)
    {
        $request = $this->connection->prepare('SELECT * FROM "bar" WHERE id = :id');
        $request->setFetchMode(\PDO::FETCH_CLASS, Bar::class);
        $request->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $bar = $request->fetch();
        if (!$bar) return null;

        $bar->addKeywords($this->getKeywords($bar->getId()));

        return $bar;
    }

    public function fetchByKeyWords($keywords)
    {
        $query = 'SELECT DISTINCT b.* FROM bar AS b JOIN keybar AS kb ON b.id = kb.idbar JOIN keyword AS kw ON kw.id = kb.idkeyword WHERE';
        for ($i = 0; $i < sizeof($keywords); $i++) {
            if ($i !== 0) $query .= ' OR';
            $query .= ' UPPER(kw.name) = UPPER(?)';
        }

        $request = $this->connection->prepare($query);
        if (!$request->execute($keywords)) return null;

        $bars = $request->fetchAll(\PDO::FETCH_CLASS, Bar::class);
        foreach($bars as $bar) {
            $bar->addKeywords($this->getKeywords($bar->getId()));
        }
        return $bars;
    }

    private function getKeywords($id)
    {
        $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw WHERE kb.idBar = b.id AND kw.id = kb.idKeyWord AND b.id = :id');
        $request->bindParam(':id',$id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        return $request->fetchAll(\PDO::FETCH_COLUMN);
    }
}
