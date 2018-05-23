<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 30/04/18
 * Time: 18:35
 */
namespace User;


class MangaRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {


        $rows = $this->connection->query('SELECT * FROM "manga" ORDER BY "nom" ')->fetchAll(\PDO::FETCH_OBJ);
        $mangas = [];
        foreach ($rows as $row) {
            $manga = new Manga();
            $manga->setNom($row->nom) ;

            if($row->auteur != null){ $manga->setAuteur($row->auteur) ;}
            if($row->genre  != null){ $manga->setGenre($row->genre)   ;}
            if($row->statut != null){ $manga->setStatut($row->statut) ;}
            if($row->note   != null){ $manga->setNote($row->note)     ;}
            if($row->nb_notes!= null){ $manga->setNbNote($row->nb_notes);}
            if($row->nb_chap!= null){ $manga->setNbChap($row->nb_chap);}
            if($row->debut  != null){ $manga->setDebut($row->debut)   ;}
            if($row->fin    != null){ $manga->setFin($row->fin)       ;}
            if($row->description    != null){ $manga->setDescription($row->description)       ;}

            $mangas[] = $manga;
        }

        return $mangas;
    }

    public function new_manga($nom,$auteur,$genre,$statut,$note,$nb_notes,$nb_chap,$debut,$fin){
        if ($fin != NULL && $debut != NULL)
            $result = $this->connection->query("INSERT INTO \"manga\"(nom,auteur,genre,statut,note,nb_notes,nb_chap,debut,fin,description) VALUES ('".$nom."','".$auteur."','".$genre."','".$statut."','".$note."','".$nb_notes."','".$nb_chap."','".$debut."','".$fin."', NULL)");
        elseif ($fin == NULL && $debut != NULL)
            $result = $this->connection->query("INSERT INTO \"manga\"(nom,auteur,genre,statut,note,nb_notes,nb_chap,debut,fin,description) VALUES ('".$nom."','".$auteur."','".$genre."','".$statut."','".$note."','".$nb_notes."','".$nb_chap."','".$debut."', NULL, NULL)");
        else
            $result = $this->connection->query("INSERT INTO \"manga\"(nom,auteur,genre,statut,note,nb_notes,nb_chap,debut,fin,description) VALUES ('".$nom."','".$auteur."','".$genre."','".$statut."','".$note."','".$nb_notes."','".$nb_chap."', NULL, NULL, NULL)");
        return $result;
    }

    public function add_chap($nom_manga,$int){
        if ($int == 1 || $int = -1){
            $result = $this->connection->query("UPDATE manga SET nb_chap = (nb_chap + (".$int.")) WHERE nom = '".$nom_manga."' ");
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function add_desc($nom_manga,$desc){
        $result = $this->connection->query("UPDATE manga SET description = '".$desc."' WHERE nom = '".$nom_manga."' ");
        return $result;
    }

}