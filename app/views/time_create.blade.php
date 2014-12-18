@extends('_master')

@section('title')
	Available times
@stop

@section('h1-title')
    <h1>Manage available days and times</h1>
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='flash-message'>{{ $message }}</div>
@endforeach

<div  class="box">
    @if (Auth::user()->Teacher == 0)
        @section('InfoForStudent')
            <!-- Name of the teacher: -->
            @foreach($teacherinfos as $teacherinfo)
                {{ "Teacher&apos;s name: ", $teacherinfo->firstname, " ", $teacherinfo->lastname }} <br>
            @endforeach

            <!-- Teacher available times: -->
        Teacher&apos;available times:<br>
            @foreach($teachertimes as $teachertime)
                {{  "&nbsp;&nbsp;&nbsp;&nbsp;", $teachertime->Day, " ", $teachertime->Start, " ", $teachertime->End }} <br>
            @endforeach
        @stop
    @endif

        <!-- User times which have been previously recorded: -->
        <br>Your recorded schedule: <br>
        @foreach($usertimes as $usertime)
            {{ "&nbsp;&nbsp;&nbsp;&nbsp;", $usertime->Day, " from ", date('H:i', strtotime($usertime->Start)), " to ", date('H:i', strtotime($usertime->End)), "&nbsp;" }} 
            <a href='/time/edit/{{$usertime['id']}}'>Edit</a><a href='/time/destroy/{{$usertime['id']}}'> Delete</a> <br>
        @endforeach
</div>

<h2>Schedule:<h2>
<table>
<tbody>
  <tr>
      {{  Form::open(array(
            'method' => 'post', 
            'action' => array('TimeController@store'))) }}

      <td class="box">
        {{ Form::label('Day') }}
        <select name="Day" class="form-control input-lg" value="">
        <option value=''>  </option>
        <option value='Monday'> Monday </option>
        <option value='Tuesday'> Tuesday </option>
        <option value='Wednesday'> Wednesday </option>
<!--        <option selected value='Wednesday'> Wednesday </option>-->
        <option value='Thursday'> Thursday </option>
        <option value='Friday'> Friday </option>
        <option value='Saturday'> Saturday </option>
        <option value='Sunday'> Sunday </option>
        </select>
    </td>
    <td class="box">
        {{ Form::label('Start') }}
        <select name="Start" class="form-control input-lg" value="">
        <option value=''>  </option>
        <option value='08:00'> 08:00 </option>
        <option value='09:00'> 09:00 </option>
        <option value='10:00'> 10:00 </option>
        <option value='11:00'> 11:00 </option>
        <option value='12:00'> 12:00 </option>
        <option value='13:00'> 13:00 </option>
        <option value='14:00'> 14:00 </option>
        <option value='15:00'> 15:00 </option>
        <option value='16:00'> 16:00 </option>
        </select>
    </td> 
    <td class="box">
        {{ Form::label('End ') }} 
        <select name="End" class="form-control input-lg">
        <option value=''>  </option>
        <option value='09:00'> 09:00 </option>
        <option value='10:00'> 10:00 </option>
        <option value='11:00'> 11:00 </option>
        <option value='12:00'> 12:00 </option>
        <option value='13:00'> 13:00 </option>
        <option value='14:00'> 14:00 </option>
        <option value='15:00'> 15:00 </option>
        <option value='16:00'> 16:00 </option>
        <option value='17:00'> 17:00 </option>
        </select>
    </td>
  </tr>
</tbody>
</table>
<br> {{ Form::submit('Submit available day and time') }}

{{ Form::close() }}

@stop