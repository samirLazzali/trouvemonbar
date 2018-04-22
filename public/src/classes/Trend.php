<?php
/**
 * Class Trend
 * Décrit une tendance.
 */

class Trend
{
    /** @var int le nombre de tweets avec ce hashtag */
    private $postCount;
    /** @var array les tweets avec ce hashtag */
    private $posts = null;

    /**
     * Trouve les tendances du réseau.
     * @param int $limit le nombre maximal de hashtags à renvoyer
     * @param int $timelimit la fenetre de temps où rechercher les tendances (en secondes)
     * @return array les tendances sous forme d'array de Trend
     */
    public static function getTrends($limit = 5, $timelimit = 3600)
    {
        $SQL = "SELECT * FROM " . TABLE_Posts . " WHERE Timestamp >= :timestamp";
        $db = connect();
        $statement = $db->prepare($SQL);
        $statement->bindValue(":timestamp", $timelimit == 0 ? 0 : time() - $timelimit);
        $statement->execute();

        $rows = $statement->fetchAll();
        $result = array();

        if (!$rows)
            return $result;

        $hashtagCount = array();
        foreach($rows as $row)
        {
            $post = Post::fromRow($row);
            $hashtags = self::getHashtags($post);

            foreach($hashtags as $hashtag)
            {
                if (isset($hashtagCount[$hashtag]))
                    $hashtagCount[$hashtag]++;
                else
                    $hashtagCount[$hashtag] = 1;
            }
        }

        asort($hashtagCount);

        if ($limit == 0)
            return $hashtagCount;

        $hashtagCount = array_reverse($hashtagCount);
        $hashtagCount = array_slice($hashtagCount, 0, $limit);
        return $hashtagCount;
    }

    public static function getHashtags($post)
    {
        $content = $post->getContent();
        $words = preg_split("/[^[:alnum:]#@]+/", $content);

        $hashtags = array();
        foreach($words as $word)
        {
            if (substr($word, 0, 1) == "#")
                array_push($hashtags, $word);
        }

        return array_unique($hashtags);
    }
}