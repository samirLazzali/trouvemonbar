<?php

namespace TagContenuMedia;

include("TagContenuMedia.php");
class TagContenuMediaRepository

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
        $rows = $this->connection->query('SELECT * FROM TagContenu JOIN Media ON TagContenu.id_media=Media.id_media;')->fetchAll(\PDO::FETCH_OBJ);
        $tagContenuMedias = [];
        foreach ($rows as $row) {
            $tagContenuMedia = new TagContenuMedia();
            $tagContenuMedia
				->setTag($row->tag)
				->setIdMedia($row->id_media)
				->setTitre($row->titre)
				->setAuteur($row->auteur)
				->setType($row->type)
				->setValide($row->valide);



            $tagContenuMedias[] = $tagContenuMedia;
        }
        return $tagContenuMedias;
    }





}

