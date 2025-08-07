<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'nic',
        'email',
        'gender',
        'contact_number',
        'whatsapp_number',
        'address',
        'branch_id',
        'course_id',
        'batch_id',
        'status',
        'isActive',
        'isFastTack'
    ];
}
