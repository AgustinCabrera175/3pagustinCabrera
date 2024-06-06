<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'students_id'
    ];
    public function student(){
        return $this->belongsTo(Student::class, 'students_id', 'id');
    }
}
