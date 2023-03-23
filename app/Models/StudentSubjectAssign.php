<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubjectAssign extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getSubject(){
        return $this->belongsTo(Subject::class, 'subject');
    }

    public function getStudent(){
        return $this->belongsTo(Student::class, 'student');
    }
}
