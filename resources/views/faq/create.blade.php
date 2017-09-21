@extends('layouts.app')

@section('title', '| Create New FAQ')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New FAQ</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'faq.store')) }}

        <div class="form-group">
            {{ Form::label('question', 'Question') }}
            {{ Form::text('question', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('answer', 'Answer') }}
            {{ Form::textarea('answer', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::submit('Create FAQ', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection