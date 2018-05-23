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

    /**
     * Ajout d'un hashtag
     * @param Hashtag $hashtag
     */
    public function add(Hashtag $hashtag)
    {
        $req = $this->db->prepare('INSERT INTO "hashtag" (mot) VALUES (:mot)');

        $req->bindValue(':mot', $hashtag->getMot());

        $req->execute();
    }

    /**
     * Suppression d'un hashtag
     * @param Hashtag $hashtag
     */
    public function delete(Hashtag $hashtag){
        $this->db->exec('DELETE FROM hashtag WHERE id = '.$hashtag->getId());
    }

    /**
     * Mise à jour d'un hashtag
     * @param Hashtag $hashtag
     */
    public function update(Hashtag $hashtag){
        $req = $this->db->prepare('UPDATE hashtag SET mot = :mot WHERE id = :id');

        $req->bindValue(':mot', $hashtag->getMot());

        $req->execute();
    }

    /**
     * Récupération d'un hashtag
     * @param int $id
     * @return Hashtag
     */
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