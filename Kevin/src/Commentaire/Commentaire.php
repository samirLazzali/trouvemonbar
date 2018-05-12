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
    private $id;

    private $owner_id;

    private $target_id;

    private $date;

    private $contenu;

    private $parent_id;

    private $parent_type;

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
    }

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * @param mixed $owener_id
     */
    public function setOwnerId($owener_id): void
    {
        $this->owener_id = $owner_id;
    }

    /**
     * @return mixed
     */
    public function getTargetId()
    {
        return $this->target_id;
    }

    /**
     * @param mixed $target_id
     */
    public function setTargetId($targer_id): void
    {
        $this->target_id = $target_id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getParentType()
    {
        return $this->partent_type;
    }

    /**
     * @param mixed $parent_type
     */
    public function setParentType($parent_type): void
    {
        $this->parent_type = $parent_type;
    }


}