<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    //Relation one to many
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    //Relation one to many
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    //Relation many to one

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }


}
