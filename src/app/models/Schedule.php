<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 14/05/18
 * Time: 14:36
 */

class Schedule
{
    /**
     * @return mixed
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * @return mixed
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * @return mixed
     */
    public function getGameid()
    {
        return $this->gameid;
    }

    private $starttime, $endtime, $gameid;
    /**
     * @brief inset a new oneshot schedule in the db
     * @param $date string
     * @param $starttime
     * @param $endtime
     * @param $gameid
     * @return bool|string db()->lastInsertId if insertion was successful. False if not
     */
    public static function insert_oneshot($date, $starttime, $endtime, $gameid)
    {
        $query = db()->prepare("INSERT INTO oneshot (starttime, endtime, date, gameid) 
                                          VALUES (?, ?, to_date( ?, 'DD-MM-YYYY' ), ?)");
        $success = $query->execute([$starttime, $endtime, $date, $gameid]);

        if($success)
            return db()->lastInsertId("oneshot_scheduleid_seq");
        else
            return false;
    }

    /**
     * @brief insert a new reccurent schedule
     * @param $day string day of the week
     * @param $reccurence int id of the reccurence in the db
     * @param $starttime
     * @param $endtime
     * @param $gameid
     * @return bool|string db()->lastInsertId if insertion was successful. False if not
     */
    public static function insert_reccurent($day, $reccurence, $starttime, $endtime, $gameid )
    {
        $query = db()->prepare("INSERT INTO reccurrent (day, gameid, reccurrenceid, starttime, endtime) 
                                          VALUES (? , ? , ? , ? , ?)");
        $success = $query->execute([$day, $gameid, $reccurence, $starttime, $endtime]);

        if($success)
            return db()->lastInsertId("schedule_scheduleid_seq");
        else
            return false;
    }
}