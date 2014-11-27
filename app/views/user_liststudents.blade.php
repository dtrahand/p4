@extends('_master')

@section('title')
	List Students
@stop

@section('content')

<h1>List of your Students</h1>

<p>
    <ul>
        @foreach($liststudents as $liststudent)
            <li>{{ $liststudent->firstname, $liststudent->lastname }}</li>
        @endforeach
    </ul>
</p>


@stop