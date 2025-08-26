<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'branch_id',
        'batch_id',
        'track',
        'is_fast_track',
        'preferred_class',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        // keyType is string on domain id
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'batch_id');
    }
}
