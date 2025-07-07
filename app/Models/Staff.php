<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Staff
 *
 * @property int $id
 * @property int $person_id
 * @property string $staff_number
 * @property string|null $hire_date
 * @property string|null $position
 * @property string|null $department
 * @property float|null $salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Person $person
 */
class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'staff_number',
        'hire_date',
        'position',
        'department',
        'salary',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public $timestamps = true;
}
