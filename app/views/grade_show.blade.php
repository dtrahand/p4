@extends('_master')

@section('title')
	List Grades
@stop

@section('content')

<h1>List of Grades</h1>

<p>
    <!-- *************************************** -->
    <!-- IF USER IS A TEACHER,                   -->
    <!-- SHOW LIST OF STUDENTS AND THEIR GRADES  -->
    <!-- *************************************** -->
    @if( Auth::user()->Teacher == 1 )
        <table class="box">
            <!-- For each students-->
            @foreach($liststudents as $liststudent)
                <tr><td style="color: #00BFFF">
                    {{ $liststudent->firstname, " ", $liststudent->lastname }}
                </td></tr>
            
                <tr>
                    <td> {{ "Date" }} </td>
                    <td> {{ "Grade" }} </td>
                </tr>

                <!-- Find the student's grades -->
                @foreach($listgrades as $listgrade)
                    @if ($liststudent->id == $listgrade->student_id)
                        <tr> 
                            <td> {{ $listgrade->date }} </td>
                            <td> {{ $listgrade->grade, " %" }} </td>
                            <td>
                                <a href='/grade/edit/{{$listgrade->id }}'>Edit</a>
                                <a href='/grade/destroy/{{$listgrade->id }}'>   Delete</a> <br>
                            </td>             
                        </tr>
                    @endif
                @endforeach

            @endforeach
        </table>
    @else
    <!-- ******************** -->
    <!-- IF USER IS A STUDENT -->
    <!-- SHOW HIS/HER GRADES  -->
    <!-- ******************** -->
        <table class="box">
            <tr>
                <td> {{ "Date" }} </td>
                <td> {{ "Grade" }} </td>
            </tr>
            
            <!-- Student's grades and test date -->
            @foreach($listgrades as $listgrade)
                <tr> 
                    <td> {{ $listgrade->date }} </td>
                    <td> {{ $listgrade->grade, " %" }} </td>
                    <td>
                        <a href='/grade/edit/{{$listgrade->id }}'>Edit</a>
                        <a href='/grade/destroy/{{$listgrade->id }}'>   Delete</a> <br>
                    </td>             
                </tr>
            @endforeach
        </table>
    @endif
</p>

 @stop 
