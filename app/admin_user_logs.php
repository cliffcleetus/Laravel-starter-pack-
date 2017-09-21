<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin_user_logs extends Model
{
  protected $fillable = [
        'user_id', 'platform', 'ip', 'login','current_login_status','logout'
    ];
}
