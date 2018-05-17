<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 2018/5/17
 * Time: 下午4:37
 */

namespace Hashtag;

class Hashtag
{
    private $id;

    private $mot;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMot()
    {
        return $this->mot;

    }

    /**
     * @param mixed $mot
     */
    public function setMot($mot): void
    {
        $this->mot = $mot;
        return $this;

    }



}