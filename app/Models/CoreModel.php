<?php

namespace App\Models;
abstract class CoreModel
{
    protected $id;
    abstract public static function findAll();


    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }
}