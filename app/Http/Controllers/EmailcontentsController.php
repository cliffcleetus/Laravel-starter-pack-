<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailContents;

class EmailcontentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['emailcontentspermission']);
    }

    
    public function index()
    {
        $emails = EmailContents::orderby('id', 'desc')->paginate(5); 
        return view('email_contents.index', compact('emails'));
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
       $email = EmailContents::findOrFail($id); //Find post of id = $id
       return view ('email_contents.view', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = EmailContents::findOrFail($id); //Find post of id = $id
       return view ('email_contents.edit', compact('email'));
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
        $this->validate($request, [
            'static_email_heading'=>'required',
            'subject'=>'required',
            'template'=>'required',
        ]);
        $email = EmailContents::findOrFail($id);
        $email->static_email_heading = $request->input('static_email_heading');
        $email->subject = $request->input('subject');
        $email->template = $request->input('template');
        $email->save();

        return redirect()->route('emailcontents.index', 
            $email->id)->with('flash_message', 
            'Email Content , '. $email->subject.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
