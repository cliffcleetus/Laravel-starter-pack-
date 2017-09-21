@extends('layouts.app')

@section('title', '| Edit Site settings')

@section('content')


  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" />
  

 <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
   
  

  
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit - {{$settings->name}} </h1>
        <hr>
            {{ Form::model($settings, array('route' => array('settings.update', $settings->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', $settings->name, array('class' => 'form-control','readonly' => 'true')) }}<br>

            {{ Form::label('value', 'Value') }}
            {{ Form::text('value', $settings->value, array('class' => 'form-control')) }}<br>

            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', $settings->description, array('class' => 'form-control')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection

