<?php
namespace App\Models;

use App\Utils\Database;
use PDO;

class Teacher extends CoreModel
{

    private $firstname;
    private $lastname;
    private $job;
    private $status;
    private $created_at;
    private $updated_at;

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
        SELECT * FROM `teacher`
        ';
        $pdoStatement = $pdo->query($sql);

        $teachers = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);

        return $teachers;
        
    }

    public static function find($id)
    {
        $pdo = Database::getPDO();
        $sql = '
        SELECT * FROM `teacher`
        WHERE `id` =' . $id 
        ;
        $pdoStatement = $pdo->query($sql);
        $teacher = $pdoStatement->fetchObject(self::class);
        return $teacher;

    }


    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = '
        INSERT INTO `teacher` (firstname, lastname, job, status, created_at)
        VALUES (:firstname, :lastname, :job, :status, NOW())
        ';
        
        $pdoStatement = $pdo->prepare($sql);

        $queryWorked = $pdoStatement->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':job' => $this->job,
            ':status' =>$this->status,
        ]);

        if ($queryWorked){
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;

    }
    
    public function update()
    {
        $pdo = Database::getPDO();
        $sql ="
        UPDATE `teacher` 
        SET firstname = :firstname, lastname = :lastname, job = :job, status = :status, updated_at= NOW() 
        WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':firstname', $this->firstname);
        $pdoStatement->bindValue(':lastname', $this->lastname);
        $pdoStatement->bindValue(':job', $this->job);
        $pdoStatement->bindValue(':status', $this->status);
        $pdoStatement->bindValue(':id', $this->id);

        $pdoStatement->execute();


    }


    // GETTERS ET SETTERS

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of job
     */ 
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set the value of job
     *
     * @return  self
     */ 
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }


}