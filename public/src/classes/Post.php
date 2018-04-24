<?php

if (!defined('__ROOT__')) define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config.php');
require_once('User.php');
require_once('Appreciation.php');

class Post implements JsonSerializable
{
    /**
     * @var null|Post une référence vers une instance de Post dont cette instance est une réponse.
     */
    private $responseToCache = null;
    /**
     * @var string l'identifiant du post dont ce Post est une réponse.
     */
    private $responseTo = null;

    private $repostOfCache = null;
    private $repostOf = null;

    private $author;
    private $authorCache = null;

    private $appreciations = null;

    private $timestamp;

    function __construct($ID, $author, $content, $timestamp)
    {
        $this->ID = $ID;
        $this->content = $content;
        $this->timestamp = $timestamp;
        $this->setAuthor($author);
    }

    /**
     * Construction à partir d'une ligne de BDD.
     * @param array $row une ligne de BDD
     * @return Post
     */
    static function fromRow($row)
    {
        $p = new Post(trim($row["id"]), $row["author"], $row["content"], $row["timestamp"]);
        $p->repostOf = $row["repost"];
        $p->responseTo = $row["responseto"];

        return $p;
    }

    /**
     * Construction à partir d'un ID de Post.
     * @param string $ID
     * @return Post
     * @throws PostNotFoundException
     */
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

    /**
     * Création d'un repost
     * @param Post|string $post le Post (ou son ID) à reposter
     * @param User|string $author l'utilisateur (ou son ID) qui reposte
     * @return Post l'instance du repost
     */
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

    /**
     * Envoie une réponse à une publication.
     * @param Post|string $post le Post (ou son ID) auquel il faut répondre.
     * @param User|string $author l'utilisateur (ou son ID) qui répond
     * @param string $content le contenu de la réponse
     * @return Post l'instance de la réponse
     */
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

    /**
     * Publie un nouveau Post.
     * @param User|string $author l'utilisateur qui publie
     * @param string $content le contenu de la publication
     * @return Post l'instance du post créé.
     */
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

    /**
     * Construction d'un post* qui recense les publications contenant un certain hashtag
     * @param string $tag
     * @return array post
     */

    static function fromHashtag($tag)
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE content like :hashtag";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":hashtag", "%".$tag."%");
        $statement->execute();

        $rows = $statement->fetchAll();
        $result = array();

        if (!$rows)
            return $result;

        foreach($rows as $row)
            $result[] = Post::fromRow($row);

        return $result;
    }

    /**
     * Construction d'un post* qui contient les $limit publications les plus aimées/détestées selon la valeur de $like (1 : les top likes, 0 ...)
     * @param int $like
     * @param int $limit
     * @param int $timelimit
     * @return array post
     * @throws PostNotFoundException
     */
    // @TODO
    static function topLikes($like = Appreciation::LIKE, $limit=10, $timelimit=7200)
    {
        $db = connect();
        $SQL = "SELECT post, count(id) as nblikes 
                FROM (SELECT * FROM " . TABLE_Appreciation . " WHERE type = :appre AND timestamp >= :timelimit ) as toto 
                GROUP BY post
                ORDER BY nblikes DESC
                LIMIT :limit";


        $statement = $db->prepare($SQL);
        $statement->bindValue(":appre", $like);
        $statement->bindValue(":limit", $limit);
        $statement->bindValue(":timelimit", $timelimit);
        $statement->execute();

        $rows = $statement->fetchAll();
        $result = array();

        foreach ($rows as $row)
            $result[] = Post::fromID($row['post']);

        return $result;
    }

    /**
     * Supprime un post de la BDD.
     */
    function delete()
    {
        $db = connect();
        $SQL = "DELETE FROM " . TABLE_Posts . " WHERE ID = :id";
        $statement = $db->prepare($SQL);
        $statement->bindParam(":id", $this->ID);
        $statement->execute();
    }

    /**
     * Supprime toutes les publications de $arr
     * @param array $arr un tableau de Post.
     */
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

    function getTimestamp()
    {
        return $this->timestamp;
    }

    function getContent()
    {
        return $this->content;
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

    /**
     * Définit la propriété repostOf du Post.
     * @param Post|int $post
     */
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

    /**
     * Renvoie le tableau des appréciations d'un Post.
     * @return array le tableau des appréciations (sous forme d'Appreciation)
     */
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
        if ($rows)
            foreach ($rows as $row)
                array_push($appreciations, Appreciation::fromRow($row));

        $this->appreciations = $appreciations;
        return $appreciations;
    }

    /**
     * Trouve les dernières publications.
     * @param array $people le filtre des personnes (noms d'utilisateur) dont on veut les publications.
     * Si c'est un tableau vide, les publications ne sont pas filtrées.
     * @param int $limit le nombre maximum de publications à renvoyer
     * @return array un tableau de Post
     * @throws UserNotFoundException si un des utilisateurs de $people n'existe pas.
     */
    static function findPosts($people, $limit = 50)
    {
        if (count($people) == 0)
            $SQL = "SELECT * FROM " . TABLE_Posts . " ORDER BY Timestamp DESC LIMIT $limit";
        else
        {
            $IDs = array();
            foreach ($people as $user) {
                $p = User::findWithIDorUsername($user);
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
        if ($rows)
            foreach($rows as $row)
                array_push($posts, Post::fromRow($row));

        return $posts;
    }

    /**
     * Trouve les hashtags contenus dans le tweet
     * @return array de string
     */
    public function getHashtags()
    {
        return Trend::getHashtags($this);
    }

    /**
     * Renvoie une représentation du tweet en HTML, avec les liens pour les mentions et les hashtags
     * @return string le code HTML
     */
    public function toHtml()
    {
        $content = $this->content;
        $ex = preg_split("/[^[:alnum:]#@]+/", $content);

        foreach($ex as $term)
        {
            $toAdd = $term;

            $firstChar = substr($term, 0, 1);
            if ($firstChar == '#')
                $content = str_replace($term, "<a class='inpost inpost-hashtag' href='hashtag/$toAdd'>$toAdd</a>", $content);
            elseif ($firstChar == '@')
                $content = str_replace($term, "<a class='inpost inpost-mention' href='profile/$toAdd'>$toAdd</a>", $content);

        }
        return $content;
    }

    /**
     * Sérialise un Post en JSON.
     * @return array|mixed
     * @throws Exception
     */
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

    /**
     * Fonction qui renvoie un tableau avec tout les post qui répondent au post courant (faite par yéti donc à check)
     * @return array (post*)
     */
    public function getResponsesTo()
    {
        $db = connect();
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE ResponseTo = :id";
        $statement = $db->prepare($SQL);
        $statement->bindValue(":id", $this->getID());
        $statement->execute();

        $rows = $statement->fetchAll();
        $result = array();

        if (!$rows)
            return $result;

        foreach($rows as $row)
            $result[] = Post::fromRow($row);

        return $result;
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