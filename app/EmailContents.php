<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailContents extends Model
{
    protected $fillable = [
        'static_email_heading', 'subject','description','template'
    ];
}
