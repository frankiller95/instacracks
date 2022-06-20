<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //relalation many to one
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    //relation many to one
    public function image(){
        return $this->belongsTo('App\Models\Image', 'image_id');
    }

}
