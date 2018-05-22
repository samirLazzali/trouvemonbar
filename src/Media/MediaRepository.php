<?php
namespace Media;
class MediaRepository
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
        $rows = $this->connection->query('SELECT * FROM "media"')->fetchAll(\PDO::FETCH_OBJ);
        $medias = [];
        foreach ($rows as $row) {
            $media = new Media();
            $media
				->setIdMedia($row->id_media)
				->setTitre($row->titre)
				->setAuteur($row->auteur)
                ->setType($row->type)
                ->setValide($row->valide);


            $medias[] = $media;
        }

        return $medias;
    }

	public function import($id_media, $titre, $auteur, $type, $tags)
	{
		//$this->connection->query('INSERT INTO media(id_media,titre, auteur) VALUES ($id_media,$titre,$auteur);');
        $req=$this->connection->prepare('INSERT INTO media(id_media, titre, auteur, "type",valide) VALUES (?,?,?,?,?);');
        $req->execute(array($id_media, $titre, $auteur, $type, "0"));


        for($i=0;$i<sizeof($tags);$i++){

         $req2=$this->connection->prepare('INSERT INTO TagContenu(tag,id_media) VALUES (?,?);');
         $req2->execute(array($tags[$i],$id_media));
        }
	}

	public function valide($id_media){
        $req=$this->connection->prepare('UPDATE media SET valide=? WHERE id_media=?;');
        $req->execute(array("1",$id_media));

    }


}
