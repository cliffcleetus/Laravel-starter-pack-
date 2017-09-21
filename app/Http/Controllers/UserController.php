<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\EmailContents;
use App\EmailQueues;
use App\User;
use App\User_logs;
use App\Settings;
use Auth;
use DB;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

//Enables us to output flash messaging
use Session;





class UserController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'isAdmin']);
         $this->middleware(['auth']); 
          //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10); 
        $roles = Role::get(); 
       //return view('users.index')->with('users', $users);
       return view('users.index', compact('users', 'roles')); 
    }

    public function customer()
    {

        $users = User::all(); 
        //$users = User::get()->where('role','=','3');
        return view('customer.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $roles = Role::get()->where('name', '!=', "User");
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data
        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected

        if (isset($roles)) {
            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        }        



        $template = "admin_user_registration";
        $email_contents = EmailContents::where('static_email_heading', '=', $template)               ->firstOrFail();   

            if(!empty($email_contents)){
            
            $email_message      =   $email_contents['template'];
            $replace_arr        =   array(
                                    'name'=>ucfirst($request->name),
                                    'email'=>$request->email,
                                    'password'=>$request->password
                                    );
            $email_message      =   $this->email_formatting($email_message,$replace_arr);
            $email_body         =   $this->create_email_body($email_message);

           /* Mail::send('users.email_template', ['user' => $email_body], function ($m) use ($email_body) {
            $m->from('hello@app.com', 'Your Application');

            $m->to('cliffiya.c@2basetechnologies.com','Test')->subject('User Registration');

             });*/

            $process_name="ADMIN USER REGISTRATION";
          //  $subject="Welcome To Laravel Starter Pack";
            $subject_det = Settings::where('name', '=',"info_name")->firstOrFail();
            $subject=$subject_det->value;

           // $to_email="hello@app.com";
            $to_name = $request->name;
            $to_email = $request->email;
            $from_email="info@starter.com";
            $from_name="Laravel";
            $this->insert_email_queue($process_name,$to_email,$to_name,$from_email,$from_name,$subject,$email_body);

            //Redirect to the users.index view and display message
            return redirect()->route('users.index')
            ->with('flash_message',
             'AdminUser successfully added.');
    }
 }


    public function email_formatting($email_body=null,$replace_arr=array(),$start_identifier='[',$end_identifier=']'){

        
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




    public function create_email_body($messageBody){
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

    public function insert_email_queue($process_name,$to_email,$to_name,$from_email,$from_name,$subject,$email_body){

       

    EmailQueues::create(['process_name'=>$process_name,
                                 'to_email' =>$to_email,
                                 'to_name'=>$to_name,
                                 'from_name'=>$from_name,
                                 'from_email' => $from_email,
                                 'subject'=>$subject,
                                 'body'=>$email_body,
                                 'sent'=>"0",
                                 'sent_status'=>"0",
                                 'read_status'=>"0",
                                 /*'time_to_send'=>,*/
                                 ]);

    }      
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::findOrFail($id);
        $user_logs = User_logs::find($id);
        $dashboard = DB::table('admin_user_logs')->where('user_id',$id)->orderby('id', 'desc')->get();
        return view('users.view', compact('dashboard','user','user_logs')); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); //Get user with specified id
         $roles = Role::get()->where('name', '!=', "User");//Get all roles

        return view('users.edit', compact('user', 'roles')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $user = User::findOrFail($id);
       $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            /*'password'=>'min:6|confirmed'*/
        ]);
        $input = $request->only(['name', 'email', 'password']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }

}
