<?php

namespace App\Models;
use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{
    private $email;
    private $password;
    private $name;
    private $role;


    public static function findAll()
    {
    }
    public static function find()
    {
    }

    public static function findByEmail($email){
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM app_user
            WHERE email = :email
        ';

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute([':email' => $email]);
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    public function insert()
    {}
    public function update()
    {}


    //  GETTERS ET SETTERS
    
    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }



    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }
}