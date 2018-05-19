<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 15/05/18
 * Time: 17:16
 */

namespace User;


class Tag
{

    /**
     * todo : attributes corresponding to the gaemtag table
     */
    public $tagid,$tagname;

    /**
     * @param $tagname
     * @return string db()->lastInsertId() id of the tag who was just added in case of success
     */
    public static function insert_tag($tagname)
    {
        $query = db()->prepare("INSERT INTO gametag (tagname) VALUES  (?)");
        $success = $query->execute([$tagname]);

        if($success)
            return db()->lastInsertId("gametag_tagid_seq");
        else
            return false;
    }



    /**
     *@return array list of all files in the database
     */
    public static function gametag_list()
    {
        $query = db()->prepare("SELECT * FROM gametag");
        $query->execute();

        return $query->fetchAll();
    }

}