<?php

require_once("../../config.php");
require_once("User.php");
require_once("Post.php");

class Appreciation implements JsonSerializable
{
    const LIKE = 'Like';
    const DISLIKE = 'Dislike';

    private $post;
    private $author;
    private $type;
    private $timestamp;

    function __construct($post, $author, $type, $timestamp)
    {
        if ($author instanceof User) {
            $this->authorCache = $author;
            $this->author = $author->getID();
        }
        else
        {
            $this->author = $author;
        }

        if ($post instanceof Post)
        {
            $this->postCache = $post;
            $this->post = $post->getID();
        }
        else
            $this->post = $post;

        if ($type != Appreciation::LIKE && $type != Appreciation::DISLIKE)
            throw new Exception("Unknown appreciation: '$type'.");

        $this->type = $type;
        $this->timestamp = $timestamp;
    }

    static function fromRow($row)
    {
        return new Appreciation($row["Post"], $row["Author"], $row["Type"], $row["Timestamp"]);
    }

    static function create($post, $author, $type)
    {
        if ($author instanceof User)
            $author = $author->getID();

        if ($post instanceof Post)
            $post = $post->getID();

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

    function jsonSerialize()
    {
        return array("type" => $this->type,
            "author" => $this->author,
            "post" => $this->post);
    }
}
?>