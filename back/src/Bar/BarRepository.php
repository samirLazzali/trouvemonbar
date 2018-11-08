<?php
namespace Bar;

class BarRepository
{
    private $connection;
    private $commentRepository;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->commentRepository = new \Comment\CommentRepository($connection);
    }

    public function fetchById($id)
    {
        $request = $this->connection->prepare('SELECT * FROM "bar" WHERE id = :id');
        $request->setFetchMode(\PDO::FETCH_CLASS, Bar::class);
        $request->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $bar = $request->fetch();

        if (!$bar) return null;
        $comments = $this->commentRepository->fetchByIdBar($id);
        $bar->addKeywords($this->getKeywords($bar->getId()));
        if (isset($comments) && sizeof($comments) > 0)
            $bar->addComments($comments);

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

    public function isStored($id)
    {
        // retourn id ou -1;
        $request = $this->connection->prepare('SELECT id FROM "bar" WHERE placeId = :placeId');
        $request->bindParam(':placeId', $id, \PDO::PARAM_INT);

        if (!$request->execute()) return null;

        $idBar = $request->fetch();
        if (!$idBar) return null;
        return $idBar;
    }

    public function creatBar($bar)
    {
        $name = $bar->getName();
        $address = $bar->getAddress();
        $photoreference = $bar->getPhoto();
        $rating = $bar->getRating();
        $placeId = $bar->getPlaceId();
        $lat = $bar->getLat();
        $lng = $bar->getLng();

        $stmt = $this->connection->prepare('INSERT INTO bar(name,rating,photoReference,placeId,address,lat,lng) VALUES (:name,:rating,:photoreference,:placeId,:address,:lat,:lng)');
        $stmt->bindParam(':name',$name, \PDO::PARAM_STR);
        $stmt->bindParam(':address',$address, \PDO::PARAM_STR);
        $stmt->bindParam(':photoreference',$photoreference, \PDO::PARAM_STR);
        $stmt->bindParam(':rating',$rating, \PDO::PARAM_STR);
        $stmt->bindParam(':placeId',$placeId, \PDO::PARAM_STR);
        $stmt->bindParam(':lat',$lat, \PDO::PARAM_STR);
        $stmt->bindParam(':lng',$lng, \PDO::PARAM_STR);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }


    public function addBarInList($pseudoUser, $idBar, $listname)
    {
        // 1 get id of list - SELECT id from list where name = :black;
        $request = $this->connection->prepare('SELECT id from list where name = :list');
        $request->bindParam(':list', $listname, \PDO::PARAM_INT);
        if (!$request->execute()) return null;
        $idList = strval($request->fetch()[0]);
        if (!$idList) return null;

        // 2 get id of user ;
        $request = $this->connection->prepare('SELECT id from "user" where pseudo = :pseudoUser');
        $request->bindParam(':pseudoUser', $pseudoUser, \PDO::PARAM_STR);
        if (!$request->execute()) return null;
        $idUser = strval($request->fetch()[0]);
        if (!$idUser) return null;

        // 3 insert on barlist
        $stmt = $this->connection->prepare('INSERT INTO barList (idBar, idUser, idList) VALUES (:idBar, :idUser, :idList)');
        $stmt->bindParam(':idBar', $idBar, \PDO::PARAM_STR);
        $stmt->bindParam(':idUser', $idUser, \PDO::PARAM_STR);
        $stmt->bindParam(':idList', $idList, \PDO::PARAM_STR);
        return $stmt->execute();
    }
}
