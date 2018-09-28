<?php
//MyReport.php
namespace App\Reports;

require_once dirname(__FILE__)."../../../vendor/koolreport/autoload.php";
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;

class Top10 extends \koolreport\KoolReport
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
        ->query("SELECT * FROM `test_papers` INNER JOIN `students` ON test_papers.student_id = students.id INNER JOIN `classes` ON students.classes_id = classes.id WHERE classes.id = ".$this->params["class"])
        ->pipe(new Sort(array(
            "score"=>"desc"
        )))
        ->pipe(new Limit(array(5)))
        ->pipe($this->dataStore('exams')); 
    }
}