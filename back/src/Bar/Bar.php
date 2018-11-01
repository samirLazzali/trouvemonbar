<?php
namespace Bar;

class Bar
{
    private $id;
    private $name;
    private $address;
    private $keywords=array();
    private $photoreference;
    private $rating;
    private $lat;
    private $lng;

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

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function addKeyword(string $keyword)
    {
        $this->keywords[] = $keyword;
    }
    public function getPhoto()
    {
        return $this->photoreference;
    }
    public function setPhoto(string $photoreference)
    {
        $this->photoreference = $photoreference;
    }
    public function getRating()
    {
        return $this->rating;
    }
    public function getLat(){
        return $this->lat;
    }
    public function getLng()
    {
        return $this->lng;
    }
    public function addKeywords(array $keywords)
    {
        if (isset($keywords) && sizeof($keywords) > 0) {
            array_push($this->keywords, ...$keywords);
        }
        return $this;
    }
}
