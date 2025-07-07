<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Teacher
 *
 * @property int $id
 * @property int $staff_id
 * @property string|null $subject_specialization
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Staff $staff
 */
class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'subject_specialization',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
