<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
