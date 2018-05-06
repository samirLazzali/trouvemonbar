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

    /**
     * @var null|User authorCache une référence vers une instance de l'utilisateur ayant créé l'appréciation
     */
    private $authorCache = null;
    /**
     * @var null|User postCache une référence vers une instance du post concerné par l'appréciation
     */
    private $postCache = null;

    function __construct($post, $author, $type, $timestamp)
    {
        if ($author instanceof User) {
            $this->authorCache = $author;
            $this->author = $author->getID();
        }
        else
            $this->author = $author;

        if ($post instanceof Post)
        {
            $this->postCache = $post;
            $this->post = $post->getID();
        }
        else
            $this->post = $post;

        if ($type != Appreciation::LIKE && $type != Appreciation::DISLIKE)
            throw new UnknownAppreciationException("Unknown appreciation: '$type'.");

        $this->type = $type;
        $this->timestamp = $timestamp;
    }

    public function getAuthor()
    {
        if ($this->authorCache == null)
            $this->authorCache = User::fromID($this->author);

        return $this->authorCache;
    }

    public function getAuthorId()
    {
        return $this->author;
    }

    public function getPost()
    {
        if ($this->postCache == null)
            $this->postCache = Post::fromID($this->post);

        return $this->postCache;
    }

    public function getPostId()
    {
        return $this->post;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Construction à partir d'une ligne de BDD.
     * @param arr $row
     * @return Appreciation
     * @throws UnknownAppreciationException si le type d'appréciation dans la ligne n'est pas reconnu.
     */
    static function fromRow($row)
    {
        return new Appreciation($row["post"], $row["author"], $row["type"], $row["timestamp"]);
    }

    /**
     * Créé une appréciation sur un post
     * @param Post|string $post la publication (ou son ID) sur laquelle créer l'appréciation
     * @param User|string $author l'utilisateur (ou son ID) qui créé l'appréciation
     * @param string $type le type d'appréciation (Like / Dislike / etc.)
     * @return Appreciation la nouvelle appréciation
     * @throws PostNotFoundException si la publication n'existe pas
     * @throws UserNotFoundException si l'utilisateur n'existe pas
     * @throws UnknownAppreciationException si $type n'est pas reconnu
     */
    static function create($post, $author, $type)
    {
        if ($author instanceof User)
            $author = $author->getID();
        else
            $author = User::fromID($author)->getID();

        if ($post instanceof Post)
            $post = $post->getID();
        else
            $post = Post::fromID($post)->getID();

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

    /**
     * Créé un like sur un post
     * @param Post|string $post la publication (ou son ID) sur laquelle créer l'appréciation
     * @param User|string $author l'utilisateur (ou son ID) qui créé l'appréciation
     * @return Appreciation la nouvelle appréciation
     * @throws PostNotFoundException si la publication n'existe pas
     * @throws UserNotFoundException si l'utilisateur n'existe pas
     */
    static function createLike($post, $author)
    {
        return Appreciation::create($post, $author, Appreciation::LIKE);
    }

    /**
     * Créé un dislike sur un post
     * @param Post|string $post la publication (ou son ID) sur laquelle créer l'appréciation
     * @param User|string $author l'utilisateur (ou son ID) qui créé l'appréciation
     * @return Appreciation la nouvelle appréciation
     * @throws PostNotFoundException si la publication n'existe pas
     * @throws UserNotFoundException si l'utilisateur n'existe pas
     */
    static function createDislike($post, $author)
    {
        return Appreciation::create($post, $author, Appreciation::DISLIKE);
    }

    /**
     * Sérialise une Appreciation en JSON
     * @return array|mixed
     */
    function jsonSerialize()
    {
        $r = array("type" => $this->type,
            "authorId" => $this->author,
            "postId" => $this->post);

        if ($this->postCache != null)
            $r["post"] = $this->postCache;
        else
            $r["post"] = null;

        if ($this->authorCache != null)
            $r["author"] = $this->authorCache;
        else
            $r["author"] = null;

        return $r;
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

class UnknownAppreciationException extends Exception
{
    protected $given;

    public function __construct($type, $code = 0, Exception $previous = null)
    {
        $message = "Unknown appreciation type : '$type'.";
        $this->given = $type;

        parent::__construct($message, $code, $previous);
    }
}