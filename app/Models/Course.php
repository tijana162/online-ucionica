<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'semestar',
        'sifra',
        'profesor',
        'opis',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->where('role', 'student');
    }
}
