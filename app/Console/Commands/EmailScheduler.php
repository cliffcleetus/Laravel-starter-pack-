<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\EmailQueues;
use Mail;

class EmailScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduleemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    $email = EmailQueues::where('sent_status',"1")->first();
    Mail::send('users.email_template', ['user' => $email->body], function ($m) use ($email){
    $m->from('hello@app.com', 'Test');
    $m->to($email->to_email,'Test')->subject($email->process_name);
        });
    $UpdateDetails = EmailQueues::where('id',$email->id)->update(array('sent_status' =>"1"));

    }
}
