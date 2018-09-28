<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'fullname',
        'gender',
        'contactnumber',
        'email',
        'age',
        'photo',
        'classes_id',
    ];
}
