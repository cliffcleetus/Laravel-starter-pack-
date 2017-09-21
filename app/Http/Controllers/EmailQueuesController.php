<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailQueues;
use App\EmailQueuesTemp;
use Mail;
//use DB;

class EmailQueuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() {
        $this->middleware(['emailqueuespermission']);
    }

    
    public function index()
    {
       $emails = EmailQueues::orderby('id', 'desc')->paginate(5); 
        return view('Emailqueues.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $email = EmailQueues::findOrFail($id); //Find post of id = $id
       return view ('Emailqueues.view', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resend($id)
    {
        $email = EmailQueues::where('id',$id)->first();
        Mail::send('users.email_template', ['user' => $email->body], function ($m) use ($email){
        $m->from('hello@app.com', 'Test');
        $m->to($email->to_email,'Test')->subject($email->process_name);
            });
        $UpdateDetails = EmailQueues::where('id',$email->id)->update(array('sent_status' =>"1"));

        return redirect()->route('emailqueues.index')
            ->with('flash_message',
             'Mail Resend Successfully.');

    }
}
