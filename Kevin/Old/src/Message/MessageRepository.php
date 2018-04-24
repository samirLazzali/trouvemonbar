<?php
namespace Message;
class MessageRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MessageRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll($emetteur, $recepteur)
    {
        $rows = $this->connection->query('SELECT * FROM "message" WHERE "recepteur"=$recepteur AND "emetteur"=$emetteur')->fetchAll(\PDO::FETCH_OBJ);
        $messages = [];
        foreach ($rows as $row) {
            $message = new Message();
            $message
                ->setId($row->id)
                ->setEmetteur($row->emetteur)
                ->setRecepteur($row->recepteur)
                ->setDate(new \DateTimeImmutable($row->date_envoie));
                ->setContenu($row->contenu);
            $messages[] = $message;
        }

        return $messages;
    }


}
