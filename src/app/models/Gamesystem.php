<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 15/05/18
 * Time: 11:40
 */

class Gamesystem
{
    /**
     * @return mixed
     */
    public function getGamesystemid()
    {
        return $this->gamesystemid;
    }

    /**
     * @param mixed $gamesystemid
     */
    public function setGamesystemid($gamesystemid)
    {
        $this->gamesystemid = $gamesystemid;
    }

    /**
     * @return mixed
     */
    public function getSystemname()
    {
        return $this->systemname;
    }

    /**
     * @param mixed $systemname
     */
    public function setSystemname($systemname)
    {
        $this->systemname = $systemname;
    }

    /**
     * @return mixed
     */
    public function getSystemdescription()
    {
        return $this->systemdescription;
    }

    /**
     * @param mixed $systemdescription
     */
    public function setSystemdescription($systemdescription)
    {
        $this->systemdescription = $systemdescription;
    }


    private $gamesystemid, $systemname, $systemdescription;
    /**
     * @return array|boolean Array of gamesystem if at least 1 was found. False if none was found.
     */
    public static function make_list()
    {
        //query
        $query = db()->prepare("SELECT * FROM gamesystem");
        $query->execute();

        //check if at least 1 row was found
        if($query->rowCount() < 1) return false;

        return $query->fetchAll(PDO::FETCH_CLASS, "Gamesystem");


    }

}






