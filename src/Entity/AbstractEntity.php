<?php

namespace App\Entity;
use Doctrine\Common\Collections\Collection;

abstract class AbstractEntity
{
    public function __tostring(): string
    {
        return $this->getId();
    }

    public function hasItems(Collection $collection): bool
    {
        if($collection->isEmpty()){
            return false;
        }

        return true;
    }
}