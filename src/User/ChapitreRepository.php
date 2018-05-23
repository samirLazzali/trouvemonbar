<?php
/**
 * Created by PhpStorm.
 * User: clement
 * Date: 05/05/18
 * Time: 16:55
 */

namespace User;


class ChapitreRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ChapitreRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "chapitre" ORDER BY nom_manga')->fetchAll(\PDO::FETCH_OBJ);
        $chapitres = [];
        foreach ($rows as $row) {
            $chapitre = new Chapitre();
            $chapitre->setNom($row->nom);
            if($row->num != null){ $chapitre->setNum($row->num) ;}
            if($row->nb_pages != null){ $chapitre->setNbPages($row->nb_pages) ;}
            if($row->nom_manga != null){ $chapitre->setNomManga($row->nom_manga) ;}
            if($row->date_pub != null){ $chapitre->setDatePub(strtotime($row->date_pub)) ;}

            $chapitres[] = $chapitre;
        }

        return $chapitres;
    }

    public function new_chapitre($nom,$num,$nb_pages,$nom_manga){
        $result = $this->connection->query("INSERT INTO \"chapitre\"(nom,num,nb_pages,nom_manga,date_pub) VALUES ('".$nom."','".$num."','".$nb_pages."','".$nom_manga."','now()')");
        return $result;
    }

    public function delete_chapitre($num,$nom_manga){
        $result = $this->connection->query("DELETE FROM \"chapitre\" WHERE num = ".$num." AND nom_manga = '".$nom_manga."' ");
        return $result;
    }

    public function limit_ten_chap(){
        $rows = $this->connection->query('SELECT * FROM "chapitre" ORDER BY nom_manga')->fetchAll(\PDO::FETCH_OBJ);
        $count = 0;
        foreach ($rows as $row){
            $count++;
        }
        if ($count < 10){
            return $count;
        }
        else {
            return 10;
        }
    }

    public function last_chaps($c){
        $rows = $this->connection->query('SELECT * FROM "chapitre" ORDER BY date_pub')->fetchAll(\PDO::FETCH_OBJ);
        $maxsize = count($rows);
        $chapitres = [];
        for ($i=0; $i<$c; $i++){
            $chapitre = new Chapitre();
            $chapitre->setNom($rows[$maxsize-$i-1]->nom);
            if($rows[$maxsize-$i-1]->num != null){ $chapitre->setNum($rows[$maxsize-$i-1]->num) ;}
            if($rows[$maxsize-$i-1]->nb_pages != null){ $chapitre->setNbPages($rows[$maxsize-$i-1]->nb_pages) ;}
            if($rows[$maxsize-$i-1]->nom_manga != null){ $chapitre->setNomManga($rows[$maxsize-$i-1]->nom_manga) ;}
            $chapitres[] = $chapitre;
        }
        return $chapitres;
    }

    public function chap_from($nom_manga,$c){
        $rows = $this->connection->query("SELECT * FROM chapitre WHERE nom_manga = '".$nom_manga."'ORDER BY date_pub")->fetchAll(\PDO::FETCH_OBJ);
        $maxsize = count($rows);
        $chapitres = [];
        for ($i=0; $i<$c; $i++){
            $chapitre = new Chapitre();
            $chapitre->setNom($rows[$maxsize-$i-1]->nom);
            if($rows[$maxsize-$i-1]->num != null){ $chapitre->setNum($rows[$maxsize-$i-1]->num) ;}
            if($rows[$maxsize-$i-1]->nb_pages != null){ $chapitre->setNbPages($rows[$maxsize-$i-1]->nb_pages) ;}
            if($rows[$maxsize-$i-1]->nom_manga != null){ $chapitre->setNomManga($rows[$maxsize-$i-1]->nom_manga) ;}
            $chapitres[] = $chapitre;
        }
        return $chapitres;
    }

    public function Size($nom_manga,$num){
        $rows = $this->connection->query("SELECT * FROM \"chapitre\" WHERE num = ".$num." AND nom_manga = '".$nom_manga."' ")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row){
            return $row->nb_pages;
        }
    }
}