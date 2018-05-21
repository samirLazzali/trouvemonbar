<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 08/05/2018
 * Time: 10:15 PM
 */

namespace Commentaire;
//require '../vendor/autoload.php';

class CommentaireManager
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

    public function add(Commentaire $com)
    {
        $req = $this->db->prepare('INSERT INTO "commentaire"(owner_id, target_id, date_envoie, contenu, parent_id, parent_type) VALUES (:owner_id, :target_id, :date_envoie, :contenu, :parent_id, :parent_type)');

        $req->bindValue(':owner_id', $com->getOwnerId());
        $req->bindValue(':target_id', $com->getTargetId());
        $req->bindValue(':date_envoie',  date_format($com->getDate(),"Y-m-d H:i:s"));
        $req->bindValue(':contenu', addslashes($com->getContenu()));
        $req->bindValue(':parent_id', $com->getParentId());
        $req->bindValue(':parent_type', $com->getParentType());

        $req->execute();
    }

    public function delete(Commentaire $com)
    {
        $this->db->exec('DELETE FROM commentaire WHERE id = '.$com->getId());
    }

    public function update(Commentaire $com)
    {
        $req = $this->db->prepare('UPDATE commentaire SET owner_id = :owner_id, target_id = :target_id, date_envoie = :date_envoie, contenu = :contenu, parent_id = :parent_id, parent_type = :parent_type WHERE id = :id');


        $req->bindValue(':owner_id', $com->getOwnerId());
        $req->bindValue(':target_id', $com->getTargetId());
        $req->bindValue(':date_envoie', $com->getDate());
        $req->bindValue(':contenu', $com->getContenu());
        $req->bindValue(':parent_id', $com->getParentId());
        $req->bindValue(':parent_type', $com->getParentType());
        $req->bindValue(':id', $com->getId());

        $req->execute();
    }

    public function get($id) {
        $id = (int) $id;

        $req = $this->db->query('SELECT owner_id, target_id, date_envoie, contenu, parent_id,  parent_type FROM commentaire WHERE id = '.$id);

        $res = $req->fetch(\PDO::FETCH_ASSOC);
        $com = new Commentaire();

        $com
            ->setId($id)
            ->setOwnerId($res['owner_id'])
            ->setTargetId($res['target_id'])
            ->setDate(new \DateTime($res['date_envoie']))
            ->setContenu($res['contenu'])
            ->setParentId($res['parent_id'])
            ->setParentType($res['parent_type']);

        return $com;

    }

}