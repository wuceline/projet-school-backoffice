<?php
namespace App\Controllers;

use App\Models\Student;
use App\Models\Teacher;


class StudentController extends CoreController
{
    public function list()
    {
        $studentsList = Student::findAll();
        $this->show('student/list',[
            'students'=>$studentsList,
        ]);
    }

    public function create()
    {
        $this->show('student/form',[
            'student'=>new Student,
            'teachers'=> Teacher::findAll(),
            ]);

    }
    public function createPost()
    {
        $student = new Student();

        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $teacherId = isset($_POST['teacher']) ? $_POST['teacher'] : '';
        $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

        $student->setFirstname($firstname);
        $student->setLastname($lastname);
        $student->setTeacher_id($teacherId);
        $student->setStatus($status);

        $student->save();
        
        global $router;
        header('Location:' .$router->generate('student-list'));
        
    }

    public function update($idStudent)
    {
        $student = Student::find($idStudent);

        $this->show('student/form', [
            'student'=>$student,
            'teachers'=> Teacher::findAll(),
        ]);

    }

    public function updatePost($idStudent)
    {
        $student = Student::find($idStudent);

        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $teacher = isset($_POST['teacher']) ? $_POST['teacher'] : '';
        $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

        $student->setFirstname($firstname);
        $student->setLastname($lastname);
        $student->setTeacher_id($teacher);
        $student->setStatus($status);

        $student->save();

        global $router;

        header('Location:' .$router->generate('student-update',['idStudent'=>$student->getId()]));

    }


}