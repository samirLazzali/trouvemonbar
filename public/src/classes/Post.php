<?php

if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once(__ROOT__ . '/classes/User.php');
require_once(__ROOT__ . '/classes/Appreciation.php');

class Post implements JsonSerializable
{
    /* L'identifiant du post */
    private $ID;
    /* Le contenu du post */
    private $content;

    private $responseToCache = null;
    private $responseTo = null;

    private $repostOfCache = null;
    private $repostOf = null;

    private $author;
    private $authorCache = null;

    private $appreciations = null;

    private $timestamp;

    /**
     * ID l'identifiant (UUID) du post
     * author : l'auteur (User) du post
     * content : le contenu du post
     */
    function __construct($ID, $author, $content, $timestamp)
    {
        $this->ID = $ID;
        $this->content = $content;
        $this->timestamp = $timestamp;
        $this->setAuthor($author);
    }

    /* Factory Method pour l'initialisation depuis une ligne de BDD */
    static function fromRow($row)
    {
        $p = new Post($row["ID"], $row["Author"], $row["Content"], $row["Timestamp"]);
        $p->repostOf = $row["Repost"];
        $p->responseTo = $row["ResponseTo"];

        return $p;
    }

    static function fromID($ID)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $ID);
        $statement->execute();
        $row = $statement->fetch();

        if (!$row)
            throw new PostNotFoundException($ID);

        return Post::fromRow($row);
    }

    /* Création d'un repost (et renvoi de l'objet Post associé) */
    static function repost($post, $author)
    {
        $id = uniqid();
        $timestamp = time();

        if ($post instanceof Post)
            $originalPostID = $post->getID();
        else
            $originalPostID = $post;

        if ($author instanceof User)
            $authorID = $author->getID();
        else
            $authorID = $author;


        $db = connect();
        $SQL = "INSERT INTO " . TABLE_Posts . " VALUES (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES (:id, :authorId, NULL, :timestamp, :originalPost, NULL)";

        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":authorId", $authorID);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->bindParam(":originalPost", $originalPostID);
        $statement->execute();

        $p = new Post($id, $author, NULL, $timestamp);
        $p->setRepostOf($post);

        return $p;
    }

    static function respondTo($post, $author, $content)
    {
        $id = uniqid();
        $timestamp = time();

        if ($post instanceof Post)
            $originalPostID = $post->getID();
        else
            $originalPostID = $post;

        if ($author instanceof User)
            $authorID = $author->getID();
        else
            $authorID = $author;

        $db = connect();
        $SQL = "INSERT INTO " . TABLE_Posts . " (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES (:id, :authorId, :content, :timestamp, NULL, :originalPost)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":authorId", $authorID);
        $statement->bindParam(":content", $content);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->bindParam(":originalPost", $originalPostID);
        $statement->execute();
        
        $p = new Post($id, $authorID, $content, $timestamp);
        $p->setResponseTo($post);

        return $p;
    }

    static function post($author, $content)
    {
        if ($author instanceof User)
            $authorID = $author->getID();
        else
            $authorID = $author;

        $id = uniqid();
        $timestamp = time();

        $db = connect();
        $SQL = "INSERT INTO " . TABLE_Posts . " (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES (:id, :authorId, :content, :timestamp, NULL, NULL)";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":authorId", $authorID);
        $statement->bindParam(":content", $content);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->execute();

        $p = new Post($id, $author, $content, $timestamp);
        return $p;
    }

    function delete()
    {
        $db = connect();
        $SQL = "DELETE FROM " . TABLE_Posts . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $this->ID);
        $statement->execute();
    }

    function deleteAll($arr)
    {
        die("TODO: Post::deleteAll");

        $db = connect();
        $SQL = "DELETE FROM " . TABLE_Posts . " WHERE ID";
    }

    /* Acesseurs classiques */

    function getID()
    {
        return $this->ID;
    }

    function getRepostID()
    {
        return $this->repostOf;
    }

    function getResponseToID()
    {
        return $this->responseTo;
    }

    function getAuthorID()
    {
        return $this->author;
    }

    /* Acesseurs renvoyant les objets associés aux identifiants */
    function getAuthor()
    {
        if ($this->authorCache != null)
            return $this->authorCache;

        $this->authorCache = User::fromID($this->author);
        return $this->authorCache;
    }

    function setAuthor($author)
    {
        if ($author instanceof User)
        {
            $this->authorCache = $author;
            $this->author = $author->getID();
        }
        else
            $this->author = $author;
    }

    function setResponseTo($resp)
    {
        if($resp instanceof Post)
        {
            $this->responseTo = $resp->getID();
            $this->responseToCache = $resp;
        }
        else
            $this->responseTo = $resp;
    }

    function getResponseTo()
    {
        if ($this->responseTo == null)
            return null;

        if ($this->responseToCache == null)
            return null;

        $this->responseToCache = Post::fromID($this->responseTo);
        return $this->responseToCache;
    }

    function getRepostOf()
    {
        if ($this->repostOf == null)
            return null;

        if ($this->repostOfCache == null)
            return null;

        $this->repostOfCache = Post::fromID($this->repostOf);
        return $this->repostOfCache;
    }

    function setRepostOf($post)
    {
        if ($post instanceof Post)
        {
            $this->repostOfCache = $post;
            $this->repostOf = $post->getID();
        }
        else
            $this->repostOf = $post;
    }

    function getAppreciations()
    {
        if ($this->appreciations != null)
            return $this->appreciations;

        $db = connect();
        $SQL = "SELECT * FROM Appreciation WHERE Post = :id";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $this->ID);
        $statement->execute();
        $rows = $statement->fetchall();

        $appreciations = array();
        foreach ($rows as $row)
            array_push($appreciations, Appreciation::fromRow($row));

        $this->appreciations = $appreciations;
        return $appreciations;
    }

    static function findPosts($people, $limit = 50)
    {
        if (count($people) == 0)
            $SQL = "SELECT * FROM " . TABLE_Posts . " ORDER BY Timestamp DESC LIMIT $limit";
        else
        {
            $IDs = array();
            foreach ($people as $user) {
                $p = User::fromUsername($user);
                array_push($IDs, $p->getID());
            }

            $SQL = "SELECT * FROM Post WHERE Author IN (";

            foreach ($IDs as $ID) {
                $SQL .= "'" . $ID . "', ";
            }
            $SQL = trim($SQL, " ,");
            $SQL .= ") ORDER BY Timestamp DESC LIMIT $limit";
        }

        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->execute();
        $rows = $statement->fetchAll();

        $posts = array();
        foreach($rows as $row)
            array_push($posts, Post::fromRow($row));

        return $posts;
    }

    public function jsonSerialize() {
        $arr = array("id" => $this->ID,
            "content" => $this->content,
            "authorId" => $this->author,
            "timestamp" => $this->timestamp,
            "repostOf" => $this->repostOf,
            "responseTo" => $this->responseTo,
            "appreciations" => $this->getAppreciations());

        return $arr;
    }
}

class PostNotFoundException extends Exception
{
    protected $givenId;

    public function __construct($givenId, $code = 0, Exception $previous = null)
    {
        $message = "No post could be found with ID '$givenId'.";
        $this->$givenId = $givenId;

        parent::__construct($message, $code, $previous);
    }
}