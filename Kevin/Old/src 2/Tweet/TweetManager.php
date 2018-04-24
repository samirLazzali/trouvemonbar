<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/4/19
 * Time: 13:36
 */
namespace Message;
require '../vendor/autoload.php';

class TweetManager{
    private $db;

    public function __construct($db_) {
        $this->db = $db_;
    }

    public function add(Tweet $tweet) {
        $req = $this->db->
            prepare('INSERT INTO "tweet"(auteur, date_envoie, contenu) 
                    VALUES (:auteur,:date_envoie,:contenu)');

        $req->bindValue(':auteur', $tweet->getAuteur());
        $req->bindValue(':date_envoie', $tweet->getDate());
        $req->bindValue(':contenu', $tweet->getContenu());
    }

    public function delete(Tweet $tweet){
        $this->db->exec('DELETE FROM "tweet" WHERE id = '.$tweet.getId());
    }

    public function update(Tweet $twe){
        $req = $this->db->prepare('UPDATE "tweet" 
                                    SET auteur = :auteur, date_envoie = :date_envoie, contenu = :contenu 
                                    WHERE id = :id');

        $req->bindValue(':auteur', $twe->getAuteur());
        $req->bindValue(':date_envoie', date_formah nat($twe->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', $twe->getContenu());
        $req->bindValue(':id', $twe->getId());

        $req->execute();
    }

    public function get($id){
        $id = (int) $id;

        $req = $this->db->query('SELECT * FROM "tweet" WHERE id = '.$id);

        $res = $req->fetch(\PDO::FETCH_OBJ);
        $twe = new Tweet();
        $twe
            ->setId($id)
            ->setAuteur($res['auteur'])
            ->setDate(new \DateTime($res['date_envoie']))
            ->setContenu($res['contenu']);

        return $twe;

    }



}