<?php

require_once("User.php");
require_once("Post.php");

class Appreciation
{
    const LIKE = 'Like';
    const DISLIKE = 'Dislike';

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

    static function create($post, $author, $type)
    {
        /* instanceof */

        $timestamp = time();
        $SQL = "INSERT INTO Appreciation (Post, Author, Type, Timestamp) VALUES (:post, :author, :type, :timestamp)";
        
    }

    static function createLike($post, $author)
    {
        return create($post, $author, Appreciation::LIKE);
    }

    static function createDislike($post, $author)
    {
        return create($post, $author, Appreciation::DISLIKE);
    }
}
?>