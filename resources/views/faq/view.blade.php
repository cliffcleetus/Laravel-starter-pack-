 @extends('layouts.app')

@section('title', '| View FAQ')

@section('content')


        <div class="box-body">
          <h3 >View - FAQ </h3>
              <table id="example2" border="1" class="table table-bordered table-hover">
                <tbody>
                <tr><td width="25%">Question</td><td>{{$pages->question}}</td></tr>
                 <tr><td>Answer</td><td>{{$pages->answer}}</td></tr>
                 <tr><td>Created at</td><td>{{$pages->created_at->format('F d, Y h:ia')}}</td></tr>
                 <tr><td>Modified at</td><td>{{ $pages->updated_at->format('F d, Y h:ia')}}</td></tr>
               </tbody>
              </table>
            </div>

            @endsection

           