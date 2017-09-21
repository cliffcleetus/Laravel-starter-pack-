<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Auth;
use DB;
use App\User;
use App\EmailContents;
use App\EmailQueues;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

    $template = "user_registration";
    $email_contents = EmailContents::where('static_email_heading', '=', $template)               ->firstOrFail();   

    if(!empty($email_contents)){
            
            $email_message      =   $email_contents['template'];
            $replace_arr        =   array(
                                    'name'=>$data['name'],
                                    'email'=>ucfirst($data['email']),
                                    'password'=>$data['password']
                                    );
            $email_message      =   $this->email_formatting($email_message,$replace_arr);
            $email_body         =   $this->create_email_body($email_message);

            Mail::send('users.email_template', ['user' => $email_body], function ($m) use ($email_body) {
            $m->from('hello@app.com', 'Your Application');

            $m->to('cliffiya.c@2basetechnologies.com','Test')->subject('User Registration');

             });

            $process_name="CUSTOMER REGISTRATION";
            $subject="Welcome To Laravel Starter Pack";
            $to_email="hello@app.com";
            $from_email="hello@app.com";
        $this->insert_email_queue($process_name,$to_email,$from_email,$subject,$email_body);

            //dd($data);

            //$data->assignRole('User');
           return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
             ]); 
            }

    }


    function email_formatting($email_body=null,$replace_arr=array(),$start_identifier='[',$end_identifier=']'){

        
        if(!empty($email_body)){
            
            if(!empty($replace_arr)){
            
                foreach($replace_arr as $key=>$replace){

                    $search=$start_identifier.$key.$end_identifier;
                    $email_body=str_ireplace($search, $replace, $email_body);

                }
            }
        }
        
        return $email_body;
    }


    public function create_email_body($messageBody) {
        $current_year = date('Y');

        $message = '<html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                            <style type="text/css">.email-body {
                                margin: 10px 0;padding: 0 10px;background: #FFFFFF;font-size: 13px;}
                                table {border-collapse: collapse;}
                                td {font-family: arial, sans-serif;}
                                .clr-bg td,.clr-bg th {text-align: left;padding: 10px 10px;}
                                .inner-div{color:#FFFFFF !important;}
                                .inner-div li{margin-left:0px;}
                                .innerpadding {padding: 18px 18px 18px 18px; }
                                @media only screen and (max-width: 720px) {table {width: 100% !important;text-align: center;}table p {text-align: center !important;}}
                                @media only screen and (max-width: 480px) {
                                body,table,td,p,a,li,blockquote {-webkit-text-size-adjust: none !important;}
                                table {width: 100% !important;text-align: center;}
                                table p {text-align: center !important;}
                                .responsive-image img {height: auto !important;max-width: 100% !important;width: 100% !important;}
                                }
                            </style>
                    </head>'
                    .'<body class="email-body">'
                        .'<table border="0" cellpadding="0" cellspacing="0" width="100%">'
                            .'<tr>'
                                .'<td>'
                                    .'<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" bgcolor="#FFFFFF">'
                                        .'<tr style="border-top:13px solid #000; background:#fff;">' 
                                            .'<a href="http://'.$_SERVER["HTTP_HOST"].'" style="color:#000" bgcolor="#000"></a>
                                            </td>'
                                        .'</tr>'
                                        .'<tr bgcolor="#000">'
                                            .'<td>'
                                                .'<table width="100%" cellspacing="0" cellpadding="0" border="0" align="right">'
                                                    .'<tbody>'  
                                                        .'<tr>
                                                            <td style="padding:0px 10px 10px 10px;vertical-align:top;">
                                                                <p style="text-align:center;color:#fff;">Laravel - Starter Pack </p>
                                                            </td>
                                                        </tr>'      
                                                        .'<tr>'
                                                            .'<td colspan="2"><div class="inner-div">';
                                                                $message .= $messageBody;
                                                                $message .='<p style="text-align:center;color: #000; font-size:13px; margin:0; background-color:#fff;"> This email was sent by Laravel - Test </p>';
                                                                $message .='</div></td>'
                                                        .'</tr>'
                                                    .'</tbody>'
                                                .'</table>'     
                                            .'</td>'
                                        .'</tr>'
                                        .'<tr style="background-color:#fff;">'
                                            .'<td bgcolor="#ffffff">'
                                                .'<table width="100%" cellspacing="0" cellpadding="0" border="0" align="right">'
                                                    .'<tbody style="background:#fff;">'
                                                        .'<tr>'
                                                            .'<td bgcolor="#fff" style="padding: 21px; border-bottom: 13px solid #000;">
                                                                <p style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000; text-align: center; padding-right: 15px; margin: 0;">Copyright &copy; '.$current_year.'
                                                                <a href="http://'.$_SERVER["HTTP_HOST"].'" title="Test" target="_blank" style="text-decoration: none;"> <span style="font-weight: normal; font-family: Arial,Helvetica,sans-serif; font-size: 13px; color: #000; text-decoration:none;">www.test.com,</span></a> All Rights Reserved</p>
                                                            </td>'
                                                        .'</tr>'        
                                                    .'</tbody>'     
                                                .'</table>'     
                                            .'</td>'        
                                        .'</tr>'
                                    .'</table>' 
                                .'</td>'
                            .'</tr>'
                        .'</table>'                 
                    .'</body>'
                .'</html>';

                return $message;                
       }



  public function insert_email_queue($process_name,$to_email,$from_email,$subject,           $email_body){

       

        $helps = EmailQueues::create(['process_name'=>$process_name,
                                 'to_email' =>$to_email,
                                 'to_name'=>"",
                                 'from_name'=>"",
                                 'from_email' => $from_email,
                                 'subject'=>$subject,
                                 'body'=>$email_body,
                                 'sent'=>"0",
                                 'sent_status'=>"0",
                                 'read_status'=>"0",
                                 /*'time_to_send'=>,*/
                                 ]);

  }      

        

}


