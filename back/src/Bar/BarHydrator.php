<?php

namespace Bar;

class BarHydrator
{
    public function extract(Bar $Bar): array
    {
        $data = [];

        if ($Bar->getId()) {
            $data['id'] = $Bar->getId();
        }
        if ($Bar->getName()) {
            $data['name'] = $Bar->getName();
        }
        if ($Bar->getAdress()) {
            $data['address'] = $Bar->getAdress();
        }

        return $data;
    }

    public function extractAll($Bars)
    {
        $data = [];
        foreach ($Bars as $Bar) {
            $data[] = $this->extract($Bar);
        }
        return $data;
    }
}
