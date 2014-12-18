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

{{print_r(Auth::user());}}
<br><br>{{print_r(Auth::user()->Teacher);}}

@if(Auth::user()->Teacher == 0)
{{" teacher = 0"}}
@else
{{" teacher = 1"}}
@endif

@stop