<?php
/**
 * Created by PhpStorm.
 * User: jo
 * Date: 15/05/18
 * Time: 11:52
 */

class Reccurrence
{

    private $reccurrenceid, $reccurrencename;

    /**
     * @return mixed
     */
    public function getReccurrenceid()
    {
        return $this->reccurrenceid;
    }

    /**
     * @return mixed
     */
    public function getReccurrencename()
    {
        return $this->reccurrencename;
    }


    public static function makelist()
    {
        //query
        $query = db()->prepare("SELECT * FROM reccurrence");
        $query->execute();

        //check if at least 1 row was found
        if($query->rowCount() < 1) return false;

        return $query->fetchAll(PDO::FETCH_CLASS, "Reccurrence");
    }

    /**
     * @param $id int id of the reccurence
     * @return string name of the reccurrence
     */
    public static function id_to_reccurrence($id)
    {
        $query = db()->prepare("SELECT reccurrencename FROM reccurrence WHERE reccurrenceid = ?");
        $query->execute([$id]);

        if($query->rowCount() != 1) return " ? ";

        $result = $query->fetch();
        return $result->reccurrencename;

    }

}

















