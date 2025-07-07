<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property int $id
 * @property int $person_id
 * @property string $enrollment_number
 * @property string|null $enrollment_date
 * @property int|null $parent_id
 * @property int|null $current_grade_level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Person $person
 * @property-read \App\Models\Person|null $parent
 */
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'enrollment_number',
        'enrollment_date',
        'parent_id',
        'current_grade_level',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    public $timestamps = true;
}
