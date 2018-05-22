<?php
namespace Tag;
class TagRepository
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
        $rows = $this->connection->query('SELECT * FROM "Tags"')->fetchAll(\PDO::FETCH_OBJ);
        $tags = [];
        foreach ($rows as $row) {
            $tag = new Tag();
            $tag
				->setIdTags($row->id_tags)
                ->setNom($row->nom);
            $tags[] = $tag;
        }

        return $tags;
    }

	public function insert($id_tags,$nom)
	{
		//$this->connection->query('INSERT INTO tags(id_tags, nom) VALUES ($id_tags,$nom);');
        $req=$this->connection->prepare('INSERT INTO tags(id_tags,nom) VALUES (?,?);');
        $req->execute(array($id_tags,$nom));
	}

}
