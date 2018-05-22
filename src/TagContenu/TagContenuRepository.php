<?php
namespace TagContenu;
class TagContenuRepository
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
        $rows = $this->connection->query('SELECT * FROM "TagContenu"')->fetchAll(\PDO::FETCH_OBJ);
        $tagContenus = [];
        foreach ($rows as $row) {
            $tagContenu = new TagContenu();
            $tagContenu
				->setTag($row->tag)
				->setImage($row->image);

            $tagContenus[] = $tagContenu;
        }
        return $tagContenus;
    }

    public function insert($tag,$image)
    {
        $req=$this->connection->prepare('INSERT INTO TagContenu(tag,image) VALUES (?,?);');
        $req->execute(array($tag, $image));
    }



}

