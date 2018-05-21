<?php
/**
 * Created by PhpStorm.
 * User: xujiahui
 * Date: 08/05/2018
 * Time: 10:08 PM
 */

namespace Commentaire;

class Commentaire
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $owner_id;

    /**
     * @var int
     */
    private $target_id;

    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @var string
     */
    private $contenu;

    /**
     * @var int
     */
    private $parent_id;

    /**
     * @var string
     */
    private $parent_type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Commentaire
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param int $owner_id
     * @return Commentaire
     */
    public function setOwnerId($owner_id)
    {
        $this->owner_id = $owner_id;
        return $this;

    }

    /**
     * @return int
     */
    public function getTargetId()
    {
        return $this->target_id;
    }

    /**
     * @param int $target_id
     * @return Commentaire
     */
    public function setTargetId($target_id)
    {
        $this->target_id = $target_id;
        return $this;

    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param int $parent_id
     * @return Commentaire
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getParentType()
    {
        return $this->parent_type;
    }

    /**
     * @param string $parent_type
     * @return Commentaire
     */
    public function setParentType($parent_type)
    {
        $this->parent_type = $parent_type;
        return $this;
    }


}