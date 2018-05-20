<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/5/17
 * Time: 下午4:38
 */
namespace Hashtag;

class HashtagRpository
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "hashtag"')->fetchAll(\PDO::FETCH_OBJ);
        $hashtags = [];
        foreach ($rows as $row) {
            $hashtag= new Hashtag();
            $hashtag
                ->setId($row->id)
                ->setMot($row->mot);
            $hashtags[] = $hashtag;
        }

        return $hashtags;
    }
}