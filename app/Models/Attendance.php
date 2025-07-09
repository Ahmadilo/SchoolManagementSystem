<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendance
 *
 * @property int $id
 * @property int $student_id
 * @property int $class_subject_id
 * @property string $date
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\ClassSubject $classSubject
 */
class Attendance extends Model
{
    use HasFactory;

    protected $table = "attendance";

    protected $fillable = [
        'student_id',
        'class_subject_id',
        'date',
        'status',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }
}
