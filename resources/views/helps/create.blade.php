@extends('layouts.app')

@section('title', '| Create Help Contents')

@section('content')


  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" />
  

 <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
   
  

  
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h3>Create New help</h3>
        <hr>
           <!--  {{ Form::model(array('route' => array('helps.store'),'enctype' => 'multipart/form-data')) }} -->

             {{ Form::open(array('route' => 'helps.store' , 'enctype' => 'multipart/form-data')) }}
            <div class="form-group">
            {{ Form::label('heading', 'Heading') }}
            {{ Form::text('heading','', array('class' => 'form-control')) }}<br>

            {{ Form::label('content', 'Content') }}
            {{ Form::textarea('content','', array('class' => 'form-control')) }}<br>

            {{ Form::label('url', 'URL') }}
            {{ Form::text('url','', array('class' => 'form-control')) }}<br>

            {{ Form::label('file', 'PDF File') }}
            {{ Form::file('file','', array('class' => 'form-control')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection


