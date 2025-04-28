<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'capacity'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
