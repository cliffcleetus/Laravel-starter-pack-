 @extends('layouts.app')

@section('title', '| Helps')

@section('content')


        <div class="box-body">
          <h3 >Helps - View  </h3>
              <table id="example2" border="1" class="table table-bordered table-hover">
                <tbody>
                <tr><td width="25%">Heading</td><td>{{$helps->heading}}</td></tr>
                 <tr><td>Content</td><td>{{$helps->content}}</td></tr>
                 <tr><td>PDF Files </td>
                 <td> 
                @if($helps->file!="") 
                <img src="{{ asset('img/mthumb.png') }}">
                <a href="{{asset('uploads/helps/').'/'.$helps->file}} ">{{$helps->file}}</a>
                
                @else No PDF files 
                @endif
                
                 </td></tr>
                 <tr><td>URL</td>
                 <td> @if($helps->url!="") <a href="{{$helps->url}} ">{{$helps->url}} </a>@else Not Specified @endif
                 </td>
                 </tr>
                 <tr><td>Created at</td><td>{{$helps->created_at->format('F d, Y h:ia')}}</td></tr>
                 <tr><td>Modified at</td><td>{{ $helps->updated_at->format('F d, Y h:ia')}}</td></tr>
               </tbody>
              </table>
            </div>

            @endsection

           