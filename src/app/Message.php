<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{
    protected $fillable = [
        'message_text',
    ];

    public function sender(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'send_user_id')->withTimestamps();
    }
}
