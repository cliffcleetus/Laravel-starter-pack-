 @extends('layouts.app')

@section('title', '| View Pages')

@section('content')


        <div class="box-body">
          <h3 >View - {{$pages->title}} </h3>
              <table id="example2" border="1" class="table table-bordered table-hover">
                <tbody>
                <tr><td width="25%">Title</td><td>{{$pages->title}}</td></tr>
                 <tr><td>Content</td><td>{!!$pages->body!!}</td></tr>
                 <tr><td>Created at</td><td>{{$pages->created_at->format('F d, Y h:ia')}}</td></tr>
                 <tr><td>Modified at</td><td>{{ $pages->updated_at->format('F d, Y h:ia')}}</td></tr>
               </tbody>
              </table>
            </div>

            @endsection

           