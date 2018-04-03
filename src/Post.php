<?php

require "User.php";

class Post
{
    /* L'identifiant du post */
    private $ID;
    /* Le contenu du post */
    private $content;

    private $postCache = null;
    private $responseTo = null;

    private $repostOfCache = null;
    private $repostOf = null;

    private $author;
    private $authorCache = null;

    /**
     * ID l'identifiant (UUID) du post
     * author : l'auteur (User) du post
     * content : le contenu du post
     */
    function __construct($ID, $author, $content, $timestamp)
    {
        $this->ID = $ID;
        $this->author = $author;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    /* Factory Method pour l'initialisation depuis une ligne de BDD */
    static function fromRow($row)
    {
        $p = new Post($row["ID"], $row["Author"], $row["Content"], $row["Timestamp"]);
        $p->repostOf = $row["Repost"];
        $p->responseTo = $row["ResponseTo"];

        return $p;
    }

    /* Création d'un repost (et renvoi de l'objet Post associé) */
    static function repost($post, $author)
    {
        $id = uniqid();
        $authorID = $author->getID();
        $originalPostID = $post->getID();
        $timestamp = time();

        $SQL = "INSERT INTO $TABLE_Posts VALUES (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES (:id, :authorId, NULL, :timestamp, :originalPost, NULL)";

        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":authorId", $authorID);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->bindParam(":originalPost", $post->getID());
        $statement->execute();

        $p = new Post($id, $author, NULL, $timestamp);
        $p->repostOf = $post;

        return $p;
    }

    static function respondTo($post, $author, $content)
    {
        $authorID = $author->getID();
        $originalPostID = $post->getID();
        $timestamp = time();

        $SQL = "INSERT INTO $TABLE_Posts VALUES (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES (:id, :authorId, :content, :timestamp, NULL, :originalPost)";

        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":authorId", $authorID);
        $statement->bindParam(":content", $content);
        $statement->bindParam(":timestamp", $timestamp);
        $statement->bindParam(":originalPost", $post->getID());
        
        $p =  new Post($id, $authorID, $content, $timestamp);
        $p->responseTo = $post;

        return $p;
    }

    static function post($author, $content)
    {
        $authorID = $author->getID();
        $id = uniqid();
        $timestamp = time();

        $SQL = "INSERT INTO $TABLE_Posts VALUES (ID, Author, Content, Timestamp, Repost, ResponseTo) VALUES (:id, :authorId, :content, :timestamp, NULL, NULL)";

        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $id);
        $statement->bindParam(":authorId", $authorID);
        $statement->bindParam(":content", $content);
        $statement->bindParam(":timestamp", $timestamp);

        $p = new Post($id, $author, $content, $timestamp);
    }

    /* CRUD ? */
    static function delete($ID)
    {
        $SQL = "DELETE FROM Post WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $ID);
        $statement->execute();
    }

    /* Acesseurs classiques */

    function getID()
    {
        return $this->ID;
    }

    /* Acesseurs pour l'auteur (objet et identifiant) */

    function getAuthorID()
    {
        return $this->author;
    }

    function getAuthor()
    {
        if ($this->authorCache != null)
            return $this->authorCache;

        $this->authorCache = User::fromID($this->author);
        return $this->authorCache;
    }
}