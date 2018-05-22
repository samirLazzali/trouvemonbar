<?php
namespace TagContenu;

class TagContenu
{
	public $tag;
	public $image;

    public function getTag()
    {
        return $this->tag;
    }


    public function setTag($tag)
    {
        $this->tag= $tag;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

   

}