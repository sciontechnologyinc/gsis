<?php
//MyReport.php
namespace App\Reports;

require_once dirname(__FILE__)."../../../vendor/koolreport/autoload.php";
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class Report extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "exams"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=gsisdb",
                    "username"=>"root",
                    "password"=>"",
                    "charset"=>"utf8"
                )
            )
        );
    }

    public function setup()
    {
        $this->src('exams')
        ->query("SELECT students.id, students.firstname,students.lastname,test_papers.created_at,test_papers.answer_sheet,classes.classname,users.name,test_papers.score FROM `test_papers` LEFT JOIN `students` ON test_papers.student_id = students.id LEFT JOIN `classes` ON students.classes_id = classes.id LEFT JOIN `users` ON users.id = classes.user_id WHERE test_papers.student_id = ".$this->params["class"]." AND test_papers.answer_sheet = 'Shapes'")
        ->pipe(new Sort(array("score"=>"desc")))
        ->pipe($this->dataStore('shapes'));
        $this->src('exams')
        ->query("SELECT students.id, students.firstname,students.lastname,test_papers.created_at,test_papers.answer_sheet,classes.classname,users.name,test_papers.score FROM `test_papers` LEFT JOIN `students` ON test_papers.student_id = students.id LEFT JOIN `classes` ON students.classes_id = classes.id LEFT JOIN `users` ON users.id = classes.user_id WHERE test_papers.student_id = ".$this->params["class"]." AND test_papers.answer_sheet = 'Colors'")
        ->pipe(new Sort(array("score"=>"desc")))
        ->pipe($this->dataStore('colors'));
        $this->src('exams')
        ->query("SELECT students.id, students.firstname,students.lastname,test_papers.created_at,test_papers.answer_sheet,classes.classname,users.name,test_papers.score FROM `test_papers` LEFT JOIN `students` ON test_papers.student_id = students.id LEFT JOIN `classes` ON students.classes_id = classes.id LEFT JOIN `users` ON users.id = classes.user_id WHERE test_papers.student_id = ".$this->params["class"]." AND test_papers.answer_sheet = 'Letters'")
        ->pipe(new Sort(array("score"=>"desc")))
        ->pipe($this->dataStore('letters'));
        $this->src('exams')
        ->query("SELECT students.id, students.firstname,students.lastname,test_papers.created_at,test_papers.answer_sheet,classes.classname,users.name,test_papers.score FROM `test_papers` LEFT JOIN `students` ON test_papers.student_id = students.id LEFT JOIN `classes` ON students.classes_id = classes.id LEFT JOIN `users` ON users.id = classes.user_id WHERE test_papers.student_id = ".$this->params["class"]." AND test_papers.answer_sheet = 'Numbers'")
        ->pipe(new Sort(array("score"=>"desc")))
        ->pipe($this->dataStore('numbers'));
    }
}