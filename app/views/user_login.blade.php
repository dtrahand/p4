@extends('_master')

@section('title')
	Log in
@stop

@section('content')

<h1>Log in</h1>

{{ Form::open(array('url' => '/login')) }}

    {{ Form::label('Email:') }}  <br>
    {{ Form::text('email') }} <br>

    {{ Form::label('Password:') }} <br>
    {{ Form::password('password') }} <br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop