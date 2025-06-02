<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koumnit extends Model
{
    protected $fillable = [
        'user_id',
        'content',
    ];

    protected $with = ['user:id,name,image','comments.user:id,name,image'];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'koumnit_like')->withTimestamps();
    }
}
