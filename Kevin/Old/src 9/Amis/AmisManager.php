<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 08/05/2018
 * Time: 10:15 PM
 */

namespace Amis;
require '../vendor/autoload.php';

class AmisManager
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

    public function add(Amis $relation)
    {
        $req = $this->db->prepare('INSERT INTO "amis"(personne1, personne2) VALUES (:personne1, :personne2)');

        $req->bindValue(':personne1', $relation->getPersonne1());
        $req->bindValue(':personne2', $relation->getPersonne2());

        $req->execute();
    }

    public function delete(Amis $relation)
    {
        $this->db->exec('DELETE FROM amis WHERE id = '.$relation->getId());
    }

    public function update(Amis $relation)
    {
        $req = $this->db->prepare('UPDATE amis SET personne1 = :personne1, personne2 = :personne2 WHERE id = :id');

        $req->bindValue(':personne1', $relation->getPersonne1());
        $req->bindValue(':personne2', $relation->getPersonne2());
        $req->bindValue(':id', $relation->getId());
        
        $req->execute();
    }

    public function get($id) {
        $id = (int) $id;

        $req = $this->db->query('SELECT personne1, personne2 FROM amis WHERE id = '.$id);

        $res = $req->fetch(\PDO::FETCH_ASSOC);
        $relation = new Amis();

        $relation
            ->setPersonne1($res['personne1'])
            ->setPersonne2($res['personne2']);
        return $relation;
    }
}