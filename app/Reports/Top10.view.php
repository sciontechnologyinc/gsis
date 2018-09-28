<?php
    use \koolreport\widgets\google\BarChart;
    BarChart::create(array(
        "dataStore"=>$this->dataStore('exams'),
        "width"=>"100%",
        "height"=>"200px",
        "columns"=>array(
            "firstname",
            "score"=>array(
                "type"=>"number",
                "label"=>"Score"
            )
        ),
        "options"=>array(
            "title"=>"Top 5 Students"
        )
    ));
?>