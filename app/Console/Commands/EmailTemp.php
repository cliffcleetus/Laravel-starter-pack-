<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailqueuetemp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Moving old emails to temp queue table';

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
        
      
        $day=7;
        $date = date("Y-m-d", strtotime('-' . $day . ' days'));//created date - 7 days
        $get_emails = EmailQueues::where('sent_status',"1")->where('created_at','<',$date )->get();


        if(!empty($get_emails) && ($get_emails!=""))
        {
            foreach ($get_emails as $mails) {
                $process_name   =$mails->process_name;
                $to_email       =$mails->to_email;
                $to_name        =$mails->to_name;
                $from_email     =$mails->from_email;
                $from_name      =$mails->from_name;
                $subject        =$mails->subject;
                $body           =$mails->body;
                $sent           =$mails->sent_status;
                $sent_status    =$mails->sent_status;
                $read_status    =$mails->read_status;
                $time_to_send   =$mails->time_to_send;

                EmailQueuesTemp::create([  'process_name'  =>$process_name,
                                            'to_email'      =>$to_email,
                                            'to_name'       => $to_name,
                                            'from_email'    =>$from_email,
                                            'from_name'     =>$from_name,
                                            'subject'       =>$subject,
                                            'body'          =>$body,
                                            'sent'          =>$sent,
                                            'sent_status'   =>$sent_status,
                                            'read_status'   =>$read_status,
                                            'time_to_send'  =>$time_to_send,

                                         ]);

                $email_mail = EmailQueues::findOrFail($mails->id); 
                $email_mail->delete();


            }
        }
    

    }
}
