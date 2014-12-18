@extends('_master')

@section('title')
	Create account
@stop

@section('content')
<h1>Create a new account</h1>
To create an account, please fill in all the fields.

@foreach($errors->all() as $message)
	<div class='flash-message'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/signup')) }}
    {{ Form::label('Firstname:') }} <br>
    {{ Form::text('Firstname') }} <br>

    {{ Form::label('Lastname:') }} <br>
    {{ Form::text('Lastname') }} <br>

{{ Form::label('Teacher / Student?') }}
    <select name="Teacher" class="form-control input-lg">
    <option value=1> Teacher </option>
    <option value=0> Student </option>
    </select>

    {{ Form::label('Email:') }}  <br>
    {{ Form::text('email') }} <br>

    {{ Form::label('Password:') }} <br>
    {{ Form::password('password') }}
    <small>Min 6 characters</small> <br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}
@stop