<?php

namespace App\DTO;
use App\Entity\Papel;

class PapelDTO
{
    public function __construct(
        public ?Papel $papel = null
    ){
    }
}