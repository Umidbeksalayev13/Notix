<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    
    public $fillable = [
        'event_id',
        'start_time',
        'end_time',
    ];
    public function event()
    {
        return $this->belongsTo(Events::class);
    }
}
