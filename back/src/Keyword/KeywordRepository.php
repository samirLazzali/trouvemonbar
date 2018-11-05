<?php
namespace Keyword;

class KeywordRepository
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $stmt = $this->connection->query('SELECT id, name FROM keyword');
        if (!$stmt) {
            return false;
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Keyword::class);
    }

    public function getIdByKeyword($keyword)
    {
        if(!isset($keyword)){
            return -1;
        }
        $stmt = $this->connection->prepare('Select id from "keyword" where name = :name');
        $stmt->bindParam(':name',$keyword, \PDO::PARAM_STR);
        if(!$stmt->execute()) return -1;
        return $stmt->fetchColumn();

    }
    public function addKeywordByUser($user_id,$keyword_ids)
    {
        if(!(isset($user_id) && is_array($keyword_ids))){
            return False;
        }
        foreach($keyword_ids as $keyword_id)
        {
            $stmt = $this->connection->prepare('INSERT INTO "keyuser"(idUser, idKeyWord) VALUES (:idUser, :idKeyword)');
            $stmt->bindParam(':idUser',$user_id, \PDO::PARAM_INT);
            $stmt->bindParam(':idKeyword',$keyword_id, \PDO::PARAM_INT);
            if(!$stmt->execute()) return False;
        }
        return True;
    }
}
