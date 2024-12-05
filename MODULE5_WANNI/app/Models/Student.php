<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Student extends Model
{
    protected $table = 'student';
    use HasFactory;
    // Allow mass assignment
    protected $fillable = [
        'nim',
        'student_name',
        'email',
        'major',
        'dosen_id',
    ];
    // Define the inverse relationship with lecturer
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'dosen_id');
    }
}
