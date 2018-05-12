<?php
namespace Message;
include("Message.php");

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

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "message"')->fetchAll(\PDO::FETCH_OBJ);
        $messages = [];
        foreach ($rows as $row) {
            $message = new Message();
            $message
                ->setId($row->id)
                ->setEmetteur($row->emetteur)
                ->setRecepteur($row->recepteur)
                ->setDate(new \DateTime($row->date_envoie)) /* Conversion de date ???*/
                ->setContenu($row->contenu);
            $messages[] = $message;
        }

        return $messages;
    }


}
