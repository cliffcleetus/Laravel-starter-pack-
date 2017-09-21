 @extends('layouts.app')

@section('title', '| View Email Contents')

@section('content')


        <div class="box-body">
          <h3 >Email Content - View  </h3>
              <table id="example2" border="1" class="table table-bordered table-hover">
                <tbody>
                <tr><td width="25%">Heading</td><td>{{$email->static_email_heading}}</td></tr>
                 <tr><td>Subject</td><td>{{$email->subject}}</td></tr>
                 <tr><td>Template</td><td>{!!$email->template!!}</td></tr>
                 <tr><td>Created at</td><td>{{$email->created_at->format('F d, Y h:ia')}}</td></tr>
                 <tr><td>Modified at</td><td>{{ $email->updated_at->format('F d, Y h:ia')}}</td></tr>
               </tbody>
              </table>
            </div>

            @endsection

           