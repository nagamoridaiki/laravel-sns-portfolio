<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Background extends Model
{
    protected $fillable = [
        'title',
        'job_detail',
        'user_id',
        'start_year',
        'start_month',
        'end_year',
        'end_month',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
