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

        $request = $this->connection->prepare('SELECT kw.name FROM "keybar" kb, "bar" b, "keyword" kw WHERE kb.idBar = b.id AND kw.id = kb.idKeyWord AND b.id = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        if ($request->execute()) $bar->addKeywords($request->fetchAll(\PDO::FETCH_COLUMN));

        return $bar;
    }

    public function fetchByKeyWords($keywords)
    {
        $query = 'SELECT DISTINCT b.* FROM bar AS b JOIN keybar AS kb ON b.id = kb.idbar JOIN keyword AS kw ON kw.id = kb.idkeyword WHERE';
        for ($i = 0; $i < sizeof($keywords); $i++) {
            if ($i !== 0) $query .= ' OR';
            $query .= ' UPPER(kw.name) = UPPER(?)';
        }

        $stmt = $this->connection->prepare($query);
        if (!$stmt->execute($keywords)) return null;

        $bars = $stmt->fetchAll(\PDO::FETCH_CLASS, Bar::CLASS);
        foreach($bars as $bar) {
            $kw = $this->getKeywords($bar->getId());
            $bar->addKeywords($kw);
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
