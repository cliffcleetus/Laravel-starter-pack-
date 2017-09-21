<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_logs extends Model
{
	protected $table = 'user_logs';
  protected $fillable = [
        'user_id', 'platform', 'ip', 'login','current_login_status','logout'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
