<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/4/19
 * Time: 13:36
 */
namespace Tweet;
//require '../vendor/autoload.php';

class TweetManager{
    private $db;

    public function __construct($db_) {
        $this->db = $db_;
    }

    /**
     * Ajout d'un tweet dans la BD
     * @param Tweet $tweet
     */
    public function add(Tweet $tweet) {
        $req = $this->db->
            prepare('INSERT INTO "tweet"(auteur, date_envoie, contenu) 
                    VALUES (:auteur,:date_envoie,:contenu)');

        $req->bindValue(':auteur', $tweet->getAuteur());
        $req->bindValue(':date_envoie',  date_format($tweet->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', $tweet->getContenu());
        $req->execute();
    }

    /**
     * Suppression d'un tweet dans la BD
     * @param Tweet $tweet
     */
    public function delete(Tweet $tweet){
        $req = 'DELETE FROM "like" WHERE tweet_id=\''.$tweet->getId().'\'';
        $this->db->exec($req);

        $req = 'DELETE FROM "hashtagEtTweet" WHERE id_tweet=\''.$tweet->getId().'\'';
        $this->db->exec($req);

        $req = 'DELETE FROM "commentaire" WHERE parent_id=\''.$tweet->getId().'\' AND parent_type=\'tweet\'';
        $this->db->exec($req);

        $req = 'DELETE FROM "tweet" WHERE id=\''.$tweet->getId().'\'';
        $this->db->exec($req);
    }

    /**
     * Mise à jour d'un tweet dans la BD
     * @param Tweet $tweet
     */
    public function update(Tweet $twe){
        $req = $this->db->prepare('UPDATE "tweet" 
                                    SET auteur=:auteur, date_envoie=:date_envoie, contenu=:contenu 
                                    WHERE id=:id');

        $req->bindValue(':auteur', $twe->getAuteur());
        $req->bindValue(':date_envoie', date_format($twe->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', $twe->getContenu());
        $req->bindValue(':id', $twe->getId());

        $req->execute();
    }

    /**
     * Récupération d'un tweet de la BD
     * @param int $id
     * @return Tweet
     */
    public function get($id){
        $sth = $this->db->prepare('SELECT * FROM "tweet" WHERE id=\''.$id.'\'');
        $sth->execute();

        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        $T = new Tweet();

        $T
            ->setId($id)
            ->setAuteur($res['auteur'])
            ->setDate(new \DateTime($res['date_envoie']))
            ->setContenu($res['contenu']);

        return $T;
    }

    public function show_tweet($pseudo,$tweet){
        echo "</br> $pseudo a tweeté à ".($tweet->getDate())->format('H:i:s')." le ".($tweet->getDate())->format('Y-m-d')." </br> ".$tweet->getContenu()."</br>";
        //print "<button> J'aime</button> Nombre de j'aime :  </br> ";
    }
    


}