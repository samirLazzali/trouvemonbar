<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/4/19
 * Time: 13:55
 */
namespace Tweet;
class TweetRepository{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection) {
        $this->connection = $connection;
    }

    public function fetchAll() {
        $rows = $this->connection->query('SELECT * FROM "tweet"')->fetchAll(\PDO::FETCH_OBJ);
        $tweets = [];
        foreach ($rows as $row) {
            $tweet = new Tweet();
            $tweet
                ->setId($row->id)
                ->setAuteur($row->auteur)
                ->setDate(new \DateTimeImmutable($row->date_envoie))
                ->setConenu($row->contenu);
            $tweets[] = $tweet;
        }
        return $tweets;
    }
}