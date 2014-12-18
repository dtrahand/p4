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
        <h4>{{ $liststudent->firstname, " ", $liststudent->lastname, ":" }} </h4>
        
            <!-- Find the student's hours -->
            @foreach($listtimes as $listtime)
                @if ($liststudent->id == $listtime->user_id)
                    <li>{{ "&nbsp;&nbsp;&nbsp;&nbsp;", $listtime->Day, ": from ", date('H:i', strtotime($listtime->Start)), " to ", date('H:i', strtotime($listtime->End)) }}</li>
                @endif
            @endforeach
        <br>
        @endforeach
    </ul>
</p>

@stop