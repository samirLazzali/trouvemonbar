<?php

require_once("User.php");
require_once("Post.php");
require_once("../db.php");

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
        /* Check instanceof */
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

        $db = connect();
        $timestamp = time();
        $SQL = "INSERT INTO Appreciation (Post, Author, Type, Timestamp) VALUES (:post, :author, :type, :timestamp)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":post", $postId);
        $statement->bindParam(":author", $authorId);
        $statement->bindParam(":type", $type);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->execute();

        return new Appreciation($post, $autor, $type, $timstamp);
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