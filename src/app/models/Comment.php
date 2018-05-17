<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 17/05/18
 * Time: 21:35
 */


class Comment
{
    private $commentid, $commentdate, $content, $gameid, $userid;

    /**
     * @return mixed
     */
    public function getCommentid()
    {
        return $this->commentid;
    }

    /**
     * @return mixed
     */
    public function getCommentdate()
    {
        return $this->commentdate;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getGameid()
    {
        return $this->gameid;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param int id of the comment
     * @return string nick of the author of the comment
     */
    public static function author($id)
    {
        $query = db()->prepare("SELECT nick FROM users natural join comment WHERE commentid = ?");
        $query->execute([$id]);

        if($query->rowCount() != 1) return "?";

        $result = $query->fetch();
        return $result->nick;
    }


    public static function insert_comment($date, $content, $gameid, $userid)
    {
        $query = db()->prepare("INSERT INTO comment (commentdate, content, gameid, userid) 
                                            VALUES (?, ?, ?, ?)");

        $success = $query->execute([$date, $content, $gameid, $userid]);
        if(!$success)
            return false;
        else
            return db()->lastInsertId("comment_commentid_seq");
    }






}












