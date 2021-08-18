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

}