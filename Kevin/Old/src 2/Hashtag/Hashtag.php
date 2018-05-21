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
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $mot;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Hashtag
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMot()
    {
        return $this->mot;

    }

    /**
     * @param string $mot
     * @return Hashtag
     */
    public function setMot($mot)
    {
        $this->mot = $mot;
        return $this;
    }



}