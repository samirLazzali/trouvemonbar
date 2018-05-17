<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/5/17
 * Time: 下午4:38
 */

namespace Hashtag;


class HashtagManager
{
    private $db;

    public function __construct(\PDO $connection)
    {
        $this->db = $connection;
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public function add(Hashtag $hashtag)
    {
        $req = $this->db->prepare('INSERT INTO "hashtag" (mot) VALUES (:mot)');

        $req->bindValue(':mot', $hashtag->getMot());

        $req->execute();
    }

    public function delete(hashtag $hashtag){
        $this->db->exec('DELETE FROM hashtag WHERE id = '.$hashtag->getId());
    }

    public function update(hashtag $hashtag){
        $req = $this->db->prepare('UPDATE hashtag SET mot = :mot WHERE id = :id');

        $req->bindValue(':mot', $hashtag->getMot());

        $req->execute();

    }

    public function get($id){
        $id = (int) $id;

        $req = $this->db->query('SELECT mot FROM hashtag WHERE id = '.$id);

        $res = $req->fetch(\PDO::FETCH_ASSOC);
        $hashtag = new Hashtag();
        $hashtag
            ->setId($id)
            ->setEot($res['mot']);


        return $hashtag;

    }

}