<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 08/05/2018
 * Time: 10:49 PM
 */

namespace Commentaire;
include("Commentaire.php");

class CommentaireRepository
{

    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "commentaire"')->fetchAll(\PDO::FETCH_OBJ);
        $messages = [];
        foreach ($rows as $row) {
            $com = new Commentaire();
            $com
                ->setId($row->id)
                ->setOwenerId($row->owener_id)
                ->setTargerId($row->targer_id)
                ->setDate($row->date_envoie)
                ->setContenu($row->contenu)
                ->setParentId($row->parent_id)
                ->setPartentType($row->partent_type);
            $commentaires[] = $com;
        }

        return $commentaires;
    }

}