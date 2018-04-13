<?php

require_once("config.php");
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
        return new Appreciation($row["post"], $row["author"], $row["type"], $row["timestamp"]);
    }

    static function create($post, $author, $type)
    {
        if ($author instanceof User)
            $author = $author->getID();

        if ($post instanceof Post)
            $post = $post->getID();
        else
        {
            // Check if the post exists, otherwise throw a PostNotFoundException
            $testPost = Post::fromID($post);
            $post = $testPost->getID();
        }
        $timestamp = time();
        $id = uniqid();

        $db = connect();
        $SQL = "DELETE FROM " . TABLE_Appreciation . " WHERE Post = :post AND Author = :user";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":post", $post);
        $statement->bindValue(":user", $author);
        $statement->execute();

        $SQL = "INSERT INTO " . TABLE_Appreciation . " (ID, Post, Author, Type, Timestamp) VALUES (:id, :post, :author, :type, :timestamp)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":post", $post);
        $statement->bindParam(":author", $author);
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

class AppreciationExistsException extends Exception
{
    protected $author;
    protected $post;

    public function __construct($author, $post, $code = 0, Exception $previous = null)
    {
        $message = "An appreciation on $post by $author already exists.";
        $this->author = $author;
        $this->post = $post;

        parent::__construct($message, $code, $previous);
    }
}
