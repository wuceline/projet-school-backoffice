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

    public static function find($id)
    {
        $pdo = Database::getPDO();
        $sql = '
        SELECT * FROM `student`
        WHERE `id` =' . $id 
        ;
        $pdoStatement = $pdo->query($sql);
        $student = $pdoStatement->fetchObject(self::class);
        return $student;

    }


    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = '
        INSERT INTO `student` (firstname, lastname, teacher_id, status, created_at)
        VALUES (:firstname, :lastname, :teacher_id, :status, NOW())
        ';
        
        $pdoStatement = $pdo->prepare($sql);

        $queryWorked = $pdoStatement->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':teacher_id' => $this->teacher_id,
            ':status' => $this->status,
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
        UPDATE `student` 
        SET firstname = :firstname, lastname = :lastname, teacher_id = :teacher_id, status = :status, updated_at = NOW() 
        WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':firstname', $this->firstname);
        $pdoStatement->bindValue(':lastname', $this->lastname);
        $pdoStatement->bindValue(':teacher_id', $this->teacher_id);
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
     * Set the value of teacher_id
     *
     * @return  self
     */ 
    public function setTeacher_id($teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }

    /**
     * Get the value of teacher_id
     */ 
    public function getTeacher_id()
    {
        return $this->teacher_id;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }
}