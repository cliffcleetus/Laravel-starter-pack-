<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailQueuesTemp extends Model
{
	protected $table = 'email_queue_tmps';
    protected $fillable = [
        'process_name','to_name','from_name', 'to_email','from_email','subject','body','sent','sent_status','read_status','time_to_send'
    ];
}
