<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


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
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function scopeVisibleTo(Builder $q, \App\Models\User $user): Builder
    {
        switch ($user->role) {
            case 'Admin':
            case 'Director':
                // full access
                return $q;

            case 'Manager':
                // same branch only (and allow NULL branch rows if you want them to fix/assign)
                return $q->where(function ($qq) use ($user) {
                    $qq->where('enrollments.branch_id', $user->branch_id)
                       ->orWhereNull('enrollments.branch_id');
                });

            case 'Sales':
                // only the students they collected
                return $q->where('enrollments.user_id', $user->id);

            default:
                // no visibility for other/unknown roles
                return $q->whereRaw('1=0');
        }
    }
}
