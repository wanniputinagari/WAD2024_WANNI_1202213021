<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this line

class Lecturer extends Model
{    
    use HasFactory;

    protected $table = 'lecturer'; 

    protected $fillable = ['lecturer_code', 'lecturer_name', 'nip', 'email', 'telephone_number'];


    // Define the one-to-many relationship with students
    public function students()
    {
        return $this->hasMany(Student::class, 'dosen_id');
    }
}


