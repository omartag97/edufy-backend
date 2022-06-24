<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $primaryKey = "meeting_id";
    public $increment = 'false';
    public $keyType = 'string';
    protected $table = 'meetings';
    protected $fillable = [
        'meeting_id',
        'user_id',
        'courseTitle',
        'ended',
    ];
    protected $hidden = [
    ];
    public function user()
    {
        return $this->belongsTo(User::class,);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'meeting_student', 'meeting_id_student','student_id','meeting_id','reg_number');
    }



}
