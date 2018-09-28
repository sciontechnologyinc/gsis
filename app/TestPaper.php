<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestPaper extends Model
{
    protected $table = "test_papers";
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'student_id',
        'score',
        'answer_sheet',
    ];
}
