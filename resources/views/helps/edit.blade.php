@extends('layouts.app')

@section('title', '| Edit Help Contents')

@section('content')


  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" />
  

 <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
   
  

  
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit - {{$helps->heading}} </h1>
        <hr>
            {{ Form::model($helps, array('route' => array('helps.update', $helps->id),'enctype' => 'multipart/form-data', 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('heading', 'Heading') }}
            {{ Form::text('heading', $helps->heading, array('class' => 'form-control')) }}<br>

            {{ Form::label('content', 'Content') }}
            {{ Form::textarea('content', $helps->content, array('class' => 'form-control')) }}<br>

            {{ Form::label('url', 'URL') }}
            {{ Form::text('url', $helps->url, array('class' => 'form-control')) }}<br>

            {{ Form::label('file', 'PDF File') }}

            {{ Form::file('file','', array('class' => 'form-control')) }}
            <br>
            @if($helps->file!="") 
                <img src="{{ asset('img/mthumb.png') }}">
                <a href="{{asset('uploads/helps/').'/'.$helps->file}} ">{{$helps->file}}</a>
                @endif
            <br>

             

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection


