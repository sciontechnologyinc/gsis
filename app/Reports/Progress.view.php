<?php
    use \koolreport\widgets\google\BarChart;
?>
<div class="col-md-12 row px-0">
    <div class="col-md-6 col-sm-12 px-0" style="border:1px;">
        <?php
            BarChart::create(array(
                "dataStore"=>$this->dataStore('exams'),
                "width"=>"100%",
                "height"=>"200px",
                "columns"=>array(
                    "created_at",
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
    </div>
    <div class="col-md-6 col-sm-12 px-0" style="border:1px;">
        <?php
            BarChart::create(array(
                "dataStore"=>$this->dataStore('exams'),
                "width"=>"100%",
                "height"=>"200px",
                "columns"=>array(
                    "created_at",
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
    </div>
    <div class="col-md-6 col-sm-12 px-0" style="border:1px;">
        <?php
            BarChart::create(array(
                "dataStore"=>$this->dataStore('exams'),
                "width"=>"100%",
                "height"=>"200px",
                "columns"=>array(
                    "created_at",
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
    </div>
    <div class="col-md-6 col-sm-12 px-0" style="border:1px;">
        <?php
            BarChart::create(array(
                "dataStore"=>$this->dataStore('exams'),
                "width"=>"100%",
                "height"=>"200px",
                "columns"=>array(
                    "created_at",
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
    </div>
</div>