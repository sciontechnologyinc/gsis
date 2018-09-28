<?php
    use \koolreport\widgets\koolphp\Table;
?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-shapes-tab" data-toggle="pill" href="#pills-shapes" role="tab" aria-controls="pills-shapes" aria-selected="true">Shapes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-colors-tab" data-toggle="pill" href="#pills-colors" role="tab" aria-controls="pills-colors" aria-selected="false">Colors</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-letters-tab" data-toggle="pill" href="#pills-letters" role="tab" aria-controls="pills-letters" aria-selected="false">Letters</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-numbers-tab" data-toggle="pill" href="#pills-numbers" role="tab" aria-controls="pills-numbers" aria-selected="false">Numbers</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-shapes" role="tabpanel" aria-labelledby="pills-shapes-tab">
      <?php
          Table::create(array(
            "dataStore"=>$this->dataStore("shapes"),
            "width"=>"100%",
            "columns"=>array(
                "firstname"=>array(
                    "label"=>"First Name",
                ),
                'lastname'=>array(
                    "label"=>"Last Name",
                ),
                'classname'=>array(
                    "label"=>"Class",
                ),
                'name'=>array(
                    "label"=>"Teacher",
                ),
                'answer_sheet'=>array(
                    "label"=>"Lesson",
                ),
                "score"=>array(
                    "type"=>"number",
                    "label"=>"Score"
                ),
                "id"=>array(
                    "label"=>"Report",
                    "formatValue"=>"<a href='report/@value'>Report</a>"
                ),
                "created_at"=>array(
                    "type"=>"datetime",
                    "label"=>"Date"
                )
            )
        ));
      ?>
  </div>
  <div class="tab-pane fade" id="pills-colors" role="tabpanel" aria-labelledby="pills-colors-tab">
      <?php
        Table::create(array(
            "dataStore"=>$this->dataStore("colors"),
            "width"=>"100%",
            "columns"=>array(
                "firstname"=>array(
                    "label"=>"First Name",
                ),
                'lastname'=>array(
                    "label"=>"Last Name",
                ),
                'classname'=>array(
                    "label"=>"Class",
                ),
                'name'=>array(
                    "label"=>"Teacher",
                ),
                'answer_sheet'=>array(
                    "label"=>"Lesson",
                ),
                "score"=>array(
                    "type"=>"number",
                    "label"=>"Score"
                ),
                "id"=>array(
                    "label"=>"Report",
                    "formatValue"=>"<a href='report/@value'>Report</a>"
                ),
                "created_at"=>array(
                    "type"=>"datetime",
                    "label"=>"Date"
                )
            )
        ));
      ?>
  </div>
  <div class="tab-pane fade" id="pills-letters" role="tabpanel" aria-labelledby="pills-letters-tab">
      <?php
        Table::create(array(
            "dataStore"=>$this->dataStore("letters"),
            "width"=>"100%",
            "columns"=>array(
                "firstname"=>array(
                    "label"=>"First Name",
                ),
                'lastname'=>array(
                    "label"=>"Last Name",
                ),
                'classname'=>array(
                    "label"=>"Class",
                ),
                'name'=>array(
                    "label"=>"Teacher",
                ),
                'answer_sheet'=>array(
                    "label"=>"Lesson",
                ),
                "score"=>array(
                    "type"=>"number",
                    "label"=>"Score"
                ),
                "id"=>array(
                    "label"=>"Report",
                    "formatValue"=>"<a href='report/@value'>Report</a>"
                ),
                "created_at"=>array(
                    "type"=>"datetime",
                    "label"=>"Date"
                )
            )
        ));
      ?>
  </div>
  <div class="tab-pane fade" id="pills-numbers" role="tabpanel" aria-labelledby="pills-numbers-tab">
      <?php
          Table::create(array(
            "dataStore"=>$this->dataStore("numbers"),
            "width"=>"100%",
            "columns"=>array(
                "firstname"=>array(
                    "label"=>"First Name",
                ),
                'lastname'=>array(
                    "label"=>"Last Name",
                ),
                'classname'=>array(
                    "label"=>"Class",
                ),
                'name'=>array(
                    "label"=>"Teacher",
                ),
                'answer_sheet'=>array(
                    "label"=>"Lesson",
                ),
                "score"=>array(
                    "type"=>"number",
                    "label"=>"Score"
                ),
                "id"=>array(
                    "label"=>"Report",
                    "formatValue"=>"<a href='report/@value'>Report</a>"
                ),
                "created_at"=>array(
                    "type"=>"datetime",
                    "label"=>"Date"
                )
            )
        ));
      ?>
  </div>
</div>