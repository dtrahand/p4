@extends('_master')

@section('title')
	List Students
@stop

@section('content')

<h1>List of the Students&apos; available hours</h1>

<p>
    <ul>
        <!-- For each students-->
        @foreach($liststudents as $liststudent)
            <li>{{ $liststudent->firstname, " ", $liststudent->lastname, ":" }}</li>
            <!-- Find the student's hours -->
            @foreach($listtimes as $listtime)
                @if ($liststudent->id == $listtime->user_id)
                    <li>{{ "&nbsp;&nbsp;&nbsp;&nbsp;", $listtime->Day, ": from ", $listtime->Start, " to ", $listtime->End }}</li>
                @endif
            @endforeach
        @endforeach
    </ul>
</p>

@stop