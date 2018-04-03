<?php

class Appreciation
{
    private $post;
    private $author;
    private $type;
    private $timestamp;

    function __construct($post, $author, $type, $timestamp)
    {
        $this->post = $post;
        $this->author = $author;
        $this->type = $type;
        $this->timestamp = $timestamp;
    }

    static function fromRow($row)
    {
        return new Appreciation($row["Post"], $row["Author"], $row["Type"], $row["Timestamp"]);
    }
}

?>