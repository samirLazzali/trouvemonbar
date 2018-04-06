<?php

if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/User.php');
require_once(__ROOT__ . '/classes/Post.php');

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
        $id = uniqid();
        $SQL = "INSERT INTO Appreciation (ID, Post, Author, Type, Timestamp) VALUES (:id, :post, :author, :type, :timestamp)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":post", $postId);
        $statement->bindParam(":author", $authorId);
        $statement->bindParam(":type", $type);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->execute();

        return new Appreciation($post, $author, $type, $timestamp);
    }

    static function createLike($post, $author)
    {
        return Appreciation::create($post, $author, Appreciation::LIKE);
    }

    static function createDislike($post, $author)
    {
        return Appreciation::create($post, $author, Appreciation::DISLIKE);
    }
}
?>