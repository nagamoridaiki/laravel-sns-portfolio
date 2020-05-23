<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'comment_user_id'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Article');
    }

    Public function user(): BelongsTo
  {
    return $this->belongsTo('App\User', 'comment_user_id', 'id', 'users');
  }
}
