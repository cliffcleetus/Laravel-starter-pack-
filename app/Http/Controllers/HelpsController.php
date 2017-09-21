<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Helps;

class HelpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['helpspermission']);
    }

    public function index()
    {
       //$helps = Helps::all()->orderby('id', 'desc')->paginate(5);
        //dd($helps);
        $helps = Helps::orderby('id', 'desc')->paginate(5);

        return view('helps.index', compact('helps'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view ('helps.create');
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
            'heading'=>'required',
            'content' =>'required',
            'file' =>'mimes:pdf|max:10000',
            'url' => 'required|url', 
            ]);

        $heading = $request['heading'];
        $content = $request['content'];
        $url     = $request['url'];
        $file    = $request->file('file');

        if($file!=""){
        $imageName = $file->getClientOriginalName();
        $path = base_path() . '/public/uploads/helps/';
        $file->move($path , $imageName);
        }else{
            $imageName="";
        }
        $helps = Helps::create( ['heading'=>$heading,
                                 'content' =>$content,
                                  'url' => $url,
                                  'status'=>1,
                                  'file'=>$imageName ]);

        //Display a successful message upon save
        return redirect()->route('helps.index')
            ->with('flash_message', 'New Help created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $helps = Helps::findOrFail($id); //Find post of id = $id
       return view ('helps.view', compact('helps'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $helps = Helps::findOrFail($id); //Find post of id = $id
       return view ('helps.edit', compact('helps'));
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
            'heading'=>'required',
            'content'=>'required',
            'file' =>'mimes:pdf|max:10000',
            'url' => 'required|url', 
        ]);
        $email = Helps::findOrFail($id);

        $email->heading = $request->input('heading');
        $email->content = $request->input('content');
        $email->url = $request->input('url');
        $pdf = $request->file('file');

        if($pdf!=""){
        $imageName = $pdf->getClientOriginalName();
        $path = base_path() . '/public/uploads/helps/';
        $pdf->move($path , $imageName);
        $email->file = $imageName;
        $email->save();
        }else{
        $imageName="";
        $email->file = $imageName;
        $email->save();
        }
        

        return redirect()->route('helps.index')->with('flash_message', 
            'page updated');
    }

    public function active($id)
    {

         $helps = Helps::find($id)->update(['status'=>1]);

        return redirect()->route('helps.index')
            ->with('flash_message',
             'Help activated successfully');
    }

    public function deactive($id)
    {
        $helps =  Helps::find($id)->update(['status'=>0]);

        return redirect()->route('helps.index')
            ->with('flash_message',
             'Help deactivated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $helps = Helps::findOrFail($id);
         $helps->delete();
        return redirect()->route('helps.index')
            ->with('flash_message',
             'Help successfully deleted');
    }
}
