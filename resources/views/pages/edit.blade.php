@extends('layouts.app')

@section('title', '| Edit Page')

@section('content')


  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" />
  

 <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
   
  

  
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Page</h1>
        <hr>
            {{ Form::model($pages, array('route' => array('pages.update', $pages->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $pages->title, array('class' => 'form-control')) }}<br>

            {{ Form::label('body', 'Content') }}
            {{ Form::textarea('body', $pages->body, array('class' => 'form-control summernote')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
 

<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300,
        tabsize: 2
      });
    });
  </script>
