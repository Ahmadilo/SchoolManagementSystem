<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentClass
 *
 * @property int $id
 * @property int $student_id
 * @property int $class_id
 * @property string $enrollment_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\SchoolClass $class
 */
class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'enrollment_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
