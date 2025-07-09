<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $title
 * @property string $message
 * @property string $sent_date
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'title',
        'message',
        'sent_date',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'sent_date' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
