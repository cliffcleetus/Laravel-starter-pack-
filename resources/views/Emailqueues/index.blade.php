@extends('layouts.app')

@section('title', '| Email Queues')

@section('content')

   


        <div class="box-body col-lg-10 col-lg-offset-1">
             <h1>Email Queues</h1>
             <br/>
              <table id="example2" class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>Sl No</th>
                    <th>Process Name</th>
                    <th>To Email</th>
                    <th>Sent Status</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $i=1; ?>
                @foreach ($emails as $email)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$email->process_name}}</td> 
                    <td>{{$email->to_email}}</td> 
                    <td>
                    @if($email->sent_status!="0")
                    {{"Sent"}}
                    @elseif($email->sent_status=="0")
                    {{"Not Sent"}}
                    @endif
                    </td> 
                    <td>{{$email->subject}}</td> 
                    <td>
                    <a title="View" href="{{ route('emailqueues.show', $email->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;"><i class="glyphicon glyphicon-eye-open"></i></a>

                     <a title="Resend" href="{{route('resend',['id'=> $email->id] )}}" class="btn btn-primary"> <i class="fa fa-refresh"></i></a>



                    </td>
                <?php  $i++; ?>
                </tr>
               @endforeach
                </tbody>
              </table>
               {{$emails->links()}}
            </div>


@endsection