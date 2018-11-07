<?php

namespace Bar;

class BarHydrator
{
    public function extract(Bar $bar): array
    {
        $data = [];

        if ($bar->getId()) {
            $data['id'] = $bar->getId();
        }
        if ($bar->getName()) {
            $data['name'] = $bar->getName();
        }
        if ($bar->getAddress()) {
            $data['address'] = $bar->getAddress();
        }
        if($bar->getKeywords())
        {
            $data['keywords'] = $bar->getKeywords();
        }
        if($bar->getRating())
        {
            $data['rating'] = $bar->getRating();
        }
        if($bar->getPhoto())
        {
            $data['photoreference'] = $bar->getPhoto();
        }
        if($bar->getLat())
        {
            $data['lat'] = $bar->getLat();
        }
        if($bar->getLng())
        {
            $data['lng'] = $bar->getLng();
        }
        if($bar->getComments())
        {
            $data['comments'] = $bar->getComments();
        }

        return $data;
    }

    public function extractAll($bars)
    {
        $data = [];
        foreach ($bars as $bar) {
            $data[] = $this->extract($bar);
        }
        return $data;
    }
}

