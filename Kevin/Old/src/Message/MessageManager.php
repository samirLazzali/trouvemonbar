<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 16/04/2018
 * Time: 17:30
 */

namespace Message;
//require '../vendor/autoload.php';


class MessageManager
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

    public function add(Message $msg)
    {
        $req = $this->db->prepare('INSERT INTO "message"(emetteur, recepteur, date_envoie, contenu) VALUES (:emetteur,:recepteur,:date_envoie,:contenu)');

        $req->bindValue(':emetteur', $msg->getEmetteur());
        $req->bindValue(':recepteur', $msg->getRecepteur());
        $req->bindValue(':date_envoie', date_format($msg->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', addslashes($msg->getContenu()));

        $req->execute();
    }

    public function delete(Message $msg){
        $this->db->exec('DELETE FROM message WHERE id = '.$msg->getId());
    }

    public function update(Message $msg){
         $req = $this->db->prepare('UPDATE message SET emetteur = :emetteur, recepteur = :recepteur, date_envoie = :date_envoie, contenu = :contenu WHERE id = :id');

        $req->bindValue(':emetteur', $msg->getEmetteur());
        $req->bindValue(':recepteur', $msg->getRecepteur());
        $req->bindValue(':date_envoie', date_format($msg->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', $msg->getContenu());
        $req->bindValue(':id', $msg->getId());

        $req->execute();

    }

    public function get($id){
        $id = (int) $id;

        $req = $this->db->query('SELECT emetteur, recepteur, date_envoie, contenu FROM message WHERE id = '.$id);

        $res = $req->fetch(\PDO::FETCH_ASSOC);
        $msg = new Message();
        $msg
                ->setId($id)
                ->setEmetteur($res['emetteur'])
                ->setRecepteur($res['recepteur'])
                ->setDate(new \DateTime($res['date_envoie'])) 
                ->setContenu($res['contenu']);

        return $msg;

    }

}