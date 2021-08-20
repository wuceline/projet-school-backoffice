<?php

namespace App\Models;
abstract class CoreModel
{
    protected $id;
    abstract public static function findAll();
    abstract public function insert();
    abstract public function update();
    
    public function save()
    {
        if ($this->id === null) {
            $this->insert();
        } else {
            $this->update();
        } 
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }
}