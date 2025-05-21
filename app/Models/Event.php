<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'location', 'organizer_id', 'slug'];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
