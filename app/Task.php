<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'due_date', 'user_id', 'description',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
