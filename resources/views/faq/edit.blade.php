@extends('layouts.app')

@section('title', '| Edit FAQ')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit FAQ</h1>
        <hr>
            {{ Form::model($pages, array('route' => array('faq.update', $pages->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('Question', 'Question') }}
            {{ Form::text('question', null, array('class' => 'form-control')) }}<br>

            {{ Form::label('answer', 'Answer') }}
            {{ Form::textarea('answer', null, array('class' => 'form-control')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection