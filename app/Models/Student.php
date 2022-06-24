<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = "reg_number";
    public $increment = 'false';
    protected $fillable = [
        'reg_number',
        'status',
        'name'
    ];
    function meetings(){
        return $this->belongsToMany(Meeting::class, 'meeting_student', 'student_id', 'meeting_id_student','reg_number','meeting_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
