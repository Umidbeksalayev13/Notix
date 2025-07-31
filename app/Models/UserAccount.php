<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $fillable = ['user_id', 'chat_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
