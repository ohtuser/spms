<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubjectAssign extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getBatch(){
        return $this->belongsTo(Batch::class, 'batch');
    }

    public function getSubject(){
        return $this->belongsTo(Subject::class, 'subject');
    }
}
