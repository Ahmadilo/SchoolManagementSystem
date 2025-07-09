<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Grade
 *
 * @property int $id
 * @property int $student_id
 * @property int $class_subject_id
 * @property string $grade_type
 * @property string $grade_date
 * @property float $score
 * @property float $max_score
 * @property float $weight
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\ClassSubject $classSubject
 */
class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_subject_id',
        'grade_type',
        'grade_date',
        'score',
        'max_score',
        'weight',
        'comments',
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
