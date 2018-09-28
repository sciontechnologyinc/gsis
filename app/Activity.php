<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activities";
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'question', 
        'choice1',
        'choice2',
        'answer',
        'classes_id',
    ];
}
