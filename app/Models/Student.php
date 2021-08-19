<?php
namespace App\Models;

use App\Utils\Database;
use PDO;

class Student extends CoreModel
{

    private $firstname;
    private $lastname;
    private $teacher_id;
    private $status;
    private $created_at;
    private $updated_at;

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = '
        SELECT * FROM `student`
        ';
        $pdoStatement = $pdo->query($sql);

        $students = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);

        return $students;
        
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = '
        INSERT INTO `student` (firstname, lastname, teacher_id, created_at)
        VALUES (:firstname, :lastname, :teacher_id, NOW())
        ';
        
        $pdoStatement = $pdo->prepare($sql);

        $queryWorked = $pdoStatement->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':teacher_id' => $this->teacher_id,
        ]);

        if ($queryWorked){
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;


    }

    public function update()
    {
        
    }

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

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }



    /**
     * Set the value of teacher_id
     *
     * @return  self
     */ 
    public function setTeacher_id($teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }
}