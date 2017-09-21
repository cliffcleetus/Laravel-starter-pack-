@extends('layouts.app')

@section('title', '| Email Contents')

@section('content')

   


        <div class="box-body col-lg-10 col-lg-offset-1">
             <h1>Email Contents</h1>
             <br/>
              <table id="example2" class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>Sl No</th>
                    <th>Heading</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $i=1; ?>
                @foreach ($emails as $email)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$email->static_email_heading}}</td> 
                    <td>{{$email->subject}}</td> 
                    <td>
                    <a href="{{ route('emailcontents.edit',$email->id) }}" class="btn btn-primary">Edit</a>

                    <a href="{{ route('emailcontents.show', $email->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>


                    </td>
                <?php  $i++; ?>
                </tr>
               @endforeach
                </tbody>
              </table>
                {{$emails->links()}}
            </div>


@endsection