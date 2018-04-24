<?php
/**
 * Created by PhpStorm.
 * User: KevinXu
 * Date: 16/04/2018
 * Time: 17:30
 */

namespace Message;
require '../vendor/autoload.php';


class MessageManager
{
    private $db;

    public function construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public function add(Message $msg)
    {
        $req = 'INSERT INTO message(emetteur, recepteur, date_envoie, contenu) VALUES ('.$msg->getEmetteur().','.$msg->getRecepteur().','.
            date_format($msg->getDate(),"Y-m-d H:i:s").','.$msg->getContenu().')';

        $this->db->query($req);
    }

    public function get($id)
    {
        $req = 'INSERT INTO message(emetteur, recepteur, date_envoie, contenu) VALUES ('.$msg->getEmetteur().','.$msg->getRecepteur().','.
            date_format($msg->getDate(),"Y-m-d H:i:s").','.$msg->getContenu().')';

        $this->db->query($req);
    }

     public function update($id)
    {
        $req = 'INSERT INTO message(emetteur, recepteur, date_envoie, contenu) VALUES ('.$msg->getEmetteur().','.$msg->getRecepteur().','.
            date_format($msg->getDate(),"Y-m-d H:i:s").','.$msg->getContenu().')';

        $this->db->query($req);
    }

    public function delete(Message $msg)
    {
        $req = 'DELETE INTO message(emetteur, recepteur, date_envoie, contenu) VALUES ('.$msg->getEmetteur().','.$msg->getRecepteur().','.
            date_format($msg->getDate(),"Y-m-d H:i:s").','.$msg->getContenu().')';

        $this->db->query($req);
    }




}