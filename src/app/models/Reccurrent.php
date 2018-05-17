<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 17/05/18
 * Time: 20:53
 */

class Reccurrent extends Schedule
{

    private $day, $reccurrence;

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getReccurrence()
    {
        return $this->reccurrence;
    }

    /**
     * @param mixed $reccurrence
     */
    public function setReccurrence($reccurrence)
    {
        $this->reccurrence = $reccurrence;
    }
}