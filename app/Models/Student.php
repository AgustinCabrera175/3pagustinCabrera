<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    
    protected $fillable = ['id',
    'dni',
    'nombre',
    'apellido',
    'fechaNacimiento',
    'curso',
];
public function assists(){
    return $this->hasMany(Assist::class, 'students_id', 'id');
}
public function logs(){
    return $this->hasMany(Log::class, 'students_id', 'id');
}
}
