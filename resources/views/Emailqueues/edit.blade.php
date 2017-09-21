@extends('layouts.app')

@section('title', '| Edit Email contents')

@section('content')


  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" />
  

 <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
   
  

  
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit - {{$email->subject}} </h1>
        <hr>
            {{ Form::model($email, array('route' => array('emailcontents.update', $email->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('static_email_heading', 'Email Heading') }}
            {{ Form::text('static_email_heading', $email->static_email_heading, array('class' => 'form-control')) }}<br>

            {{ Form::label('subject', 'Subject') }}
            {{ Form::text('subject', $email->subject, array('class' => 'form-control')) }}<br>

            {{ Form::label('template', 'Template') }}
            {{ Form::textarea('template', $email->template, array('class' => 'form-control summernote')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 

<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300,
        tabsize: 2
      });
    });
  </script>

