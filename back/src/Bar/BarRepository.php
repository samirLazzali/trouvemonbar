<?php
namespace Bar;

class BarRepository
{
    private $connection;
    private $keywordRepository;
    private $commentRepository;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->keywordRepository = new \Keyword\KeywordRepository($connection);
        $this->commentRepository = new \Comment\CommentRepository($connection);
    }

    public function fetchById($id)
    {
        $request = $this->connection->prepare('SELECT * FROM "bar" WHERE id = :id');
        $request->setFetchMode(\PDO::FETCH_CLASS, Bar::class);
        $request->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $bar = $request->fetch();

        $bar->addKeywords($this->keywordRepository->getKeywordsByBarId($bar->getId()));

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
            $bar->addKeywords($this->keywordRepository->getKeywordsByBarId($bar->getId()));
        }
        return $bars;
    }
}
