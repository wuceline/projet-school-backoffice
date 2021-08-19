<?php
namespace App\Controllers;

use App\Models\Teacher;

class TeacherController extends CoreController
{
    public function list()
    {
        $teachersList = Teacher::findAll();
        $this->show('teacher/list',[
            'teachers'=>$teachersList,
        ]);
    }

    public function create()
    {
        $this->show('teacher/form',['teacher'=>new Teacher]);

    }
    public function createPost()
    {
        $teacher = new Teacher();

        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $job = isset($_POST['job']) ? $_POST['job'] : '';
        $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

        $teacher->setFirstname($firstname);
        $teacher->setLastname($lastname);
        $teacher->setJob($job);
        $teacher->setStatus($status);
        $teacher->save();
        global $router;
        header('Location:' .$router->generate('teacher-list'));
        
    }

    public function update($idTeacher)
    {
        $teacher = Teacher::find($idTeacher);

        $this->show('teacher/form', [
            'teacher'=>$teacher,
        ]);

    }

    public function updatePost($idTeacher)
    {
        $teacher = Teacher::find($idTeacher);

        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $job = isset($_POST['job']) ? $_POST['job'] : '';
        $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

        $teacher->setFirstname($firstname);
        $teacher->setLastname($lastname);
        $teacher->setJob($job);
        $teacher->setStatus($status);
        $teacher->save();


        global $router;

        header('Location:' .$router->generate('teacher-update',['idTeacher'=>$teacher->getId()]));

    }


}