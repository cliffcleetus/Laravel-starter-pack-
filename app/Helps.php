<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helps extends Model
{
   protected $fillable = [
        'heading', 'content','file','url','status'
    ];
}
