<?php
namespace Bar;

class Bar
{
    private $id;
    private $name;
    private $address;
    private $keywords;

    function __construct()
    {
        $this->keywords = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    
    public function addKeyword($keyword)
    {
        $this->keywords[] = $keyword; 
    }

    public function addKeywords($keyword)
    {
        array_push($this->keywords, ...$keyword);
    }
}
