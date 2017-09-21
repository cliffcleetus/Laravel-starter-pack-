<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['faqspermission']);
    }

    public function index()
    {
         $faq = Faq::orderby('id', 'desc')->paginate(5); 
        return view('faq.index', compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    return view('faq.create');
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
            'question'=>'required',
            'answer' =>'required',
            ]);

        $question = $request['question'];
        $answer = $request['answer'];

        $post = Faq::create($request->only('question', 'answer'));

    //Display a successful message upon save
        return redirect()->route('faq.index')
            ->with('flash_message', 'FAQ,
             '. $post->question.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pages = Faq::findOrFail($id); //Find post of id = $id
        return view ('faq.view', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $pages = Faq::findOrFail($id); 
      return view ('faq.edit', compact('pages'));

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
            'question'=>'required',
            'answer' =>'required',
            ]);
        $post = Faq::findOrFail($id);
        $post->question = $request->input('question');
        $post->answer = $request->input('answer');
        $post->save();

        return redirect()->route('faq.index', 
            $post->id)->with('flash_message', 
            'FAQ updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Faq::findOrFail($id);
        $post->delete();
        return redirect()->route('faq.index')
            ->with('flash_message',
             'FAQ successfully deleted');
    }

    public function active($id)
    {

       // dd(Faq::find($id));
        Faq::find($id)->update(['status'=>1]);
        return redirect()->route('faq.index')
            ->with('flash_message',
             'FAQ activated successfully');
    }

    public function deactive($id)
    {
        // dd(Faq::find($id));
        Faq::find($id)->update(['status'=>0]);
        return redirect()->route('faq.index')
            ->with('flash_message',
             'FAQ deactivated successfully');
    }


}
