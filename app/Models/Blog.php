<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['slug', 'title', 'short_description', 'description', 'user_id'];
    public function creator(){
        return $this->belongsTo('App\Models\User', 'creator_id');
    }
}
