<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/4/19
 * Time: 13:36
 */
namespace Tweet;
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
        $req->execute();
    }

    public function delete(Tweet $tweet){
        $this->db->exec('DELETE FROM "tweet" WHERE id = '.$tweet.getId());
    }

    public function update(Tweet $twe){
        $req = $this->db->prepare('UPDATE "tweet" 
                                    SET auteur = :auteur, date_envoie = :date_envoie, contenu = :contenu 
                                    WHERE id = :id');

        $req->bindValue(':auteur', $twe->getAuteur());
        $req->bindValue(':date_envoie', date_format($twe->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', $twe->getContenu());
        $req->bindValue(':id', $twe->getId());

        $req->execute();
    }

    public function get($pseudo){
        $sth = $this->db->prepare('SELECT * FROM "tweet" WHERE auteur=\''.$pseudo.'\'');
        $sth->execute();
        return $sth ;
        

    }

    public function show_tweet($tweet){
        print "</br> $tweet->auteur a tweeté à $tweet->date_envoie : </br> $tweet->contenu </br>";
        print "<button> J'aime</button> Nombre de j'aime :  </br> ";
    }
    


}