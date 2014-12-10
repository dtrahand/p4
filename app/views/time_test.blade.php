@extends('_master')

@section('title')
	test
@stop

@section('h1-title')
    <h1>this is a test page</h1>
@stop

@section('content')

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{"id = ", $id}}


@stop