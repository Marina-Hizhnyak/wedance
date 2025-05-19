<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'role',
        'description',
        'quote',
        'telegram_url',
        'whatsapp_url',
        'vk_url',
        'user_id',
        'avatar',
        'photo',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
