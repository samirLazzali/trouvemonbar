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
     * @param int|null $gamesystemid
     */
    public function setGamesystemid($gamesystemid)
    {
        $this->gamesystemid = $gamesystemid;
    }

    /**
     * @param mixed $systemname
     */
    public function setSystemname($systemname)
    {
        $this->systemname = $systemname;
    }

    /**
     * @param mixed $systemdescription
     */
    public function setSystemdescription($systemdescription)
    {
        $this->systemdescription = $systemdescription;
    }
    /**
     * @return mixed
     */
    public function getSystemname()
    {
        return $this->systemname;
    }

    /**
     * @return mixed
     */
    public function getSystemdescription()
    {
        return $this->systemdescription;
    }


    protected $gamesystemid, $systemname, $systemdescription;
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

    /**
     * @param $id int id of the system
     * @return false if nothing was found (or more than 1 row), systemname if something found
     */
    public static function id_to_name($id)
    {
        $query = db()->prepare("SELECT systemname FROM gamesystem WHERE gamesystemid = ?");
        $query->execute([$id]);

        if($query->rowCount() != 1 ) return false;
        $result = $query->fetch();
        return $result->systemname;

    }

    /**
     * Gamesystem constructor.
     * @param $gamesystemid int
     * @throws Exception system not found
     */
    public function __construct($gamesystemid=null)
    {
        //if we are building via constructor
        if($gamesystemid !== null) {
            $this->gamesystemid = $gamesystemid;

            //query
            $query = db()->prepare("SELECT * FROM gamesystem WHERE gamesystemid = ?");
            $query->execute([$gamesystemid]);

            if ($query->rowCount() != 1) throw  new  Exception("System can't be found :" . $gamesystemid);

            $system = $query->fetch();

            //inject results from database columns into the object
            foreach (['systemname', 'systemdescription'] as $attr) {
                $this->$attr = $system->$attr;
            }
        }
        //if not we are bulding via fetch_class
    }

    /**
     * @return int number of gms for this system
     */
    public function get_gms_number()
    {
        $query = db()->prepare("SELECT DISTINCT COUNT(userid) as nb_gms 
                                          FROM gamesystem LEFT JOIN mastery m2 on gamesystem.gamesystemid = m2.gamesystemid 
                                          WHERE m2.gamesystemid = ?");
        $query->execute([$this->gamesystemid]);
        return $query->fetch()->nb_gms;
    }

    /**
     * @param $name string
     * @param $desc string
     * @return bool was the insertion successful
     */
    public static function insert($name, $desc)
    {
        $query = db()->prepare("INSERT INTO gamesystem (systemname, systemdescription) VALUES (?, ?)");
        return $query->execute([$name, $desc]);

    }

    /**
     * @return bool was update successful
     */
    public function update()
    {
        $query = db()->prepare("UPDATE gamesystem 
                                          SET systemname = ?, systemdescription = ? 
                                          WHERE gamesystemid = ? ");
        return $query->execute([$this->systemname, $this->systemdescription, $this->gamesystemid]);
    }

    /**
     * @return bool deletion was successful
     */
    public function delete()
    {
        $query = db()->prepare("DELETE FROM gamesystem WHERE gamesystemid = ?");
        return $query->execute([$this->gamesystemid]);
    }

}














