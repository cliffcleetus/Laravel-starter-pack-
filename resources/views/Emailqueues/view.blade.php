 @extends('layouts.app')

@section('title', '| View Email Queues')

@section('content')


        <div class="box-body">
          <h3 >Email Queues - View  </h3>
              <table id="example2" border="1" class="table table-bordered table-hover">
                <tbody>
                <tr><td width="25%">Process Name</td><td>{{$email->process_name}}</td></tr>
                 <tr><td >To Name</td><td>{{$email->to_name}}</td></tr>
                 <tr><td >To Email</td><td>{{$email->to_email}}</td></tr>
                 <tr><td >From Name</td><td>{{$email->from_name}}</td></tr>
                 <tr><td >From Email</td><td>{{$email->from_email}}</td></tr>
                 <tr><td>Subject</td><td>{{$email->subject}}</td></tr>
                 <tr><td>Template</td><td>{!!$email->body!!}</td></tr>
                 <tr><td>Status</td><td>
                  @if($email->sent_status!="0")
                    {{"Sent"}}
                    @elseif($email->sent_status=="0")
                    {{"Not Sent"}}
                  @endif
                 </td></tr>
                 <tr><td>Created at</td><td>{{$email->created_at->format('F d, Y h:ia')}}</td></tr>
                 <tr><td>Modified at</td><td>{{ $email->updated_at->format('F d, Y h:ia')}}</td></tr>
               </tbody>
              </table>
            </div>

            @endsection

           