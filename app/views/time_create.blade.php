@extends('_master')

@section('title')
	Available times
@stop

@section('content')
<h1>Manage available days and times</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array(
    'method'=>'POST'))
}}

<br>{{ print_r("$teacherinfos") }}
<br>{{ print_r("$teachertimes") }}

<br>    {{ "Monday Schedule" }} <br>

    {{ Form::label('Start:') }} <br>
    <select name="MondayStart" class="form-control input-lg" value="09:00">
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

    {{ Form::label('End:') }} <br>
    <select name="MondayEnd" class="form-control input-lg">
    <option value='09:00'> 09:00 </option>
    <option value='10:00'> 10:00 </option>
    <option value='11:00'> 11:00 </option>
    <option value='12:00'> 12:00 </option>
    <option value='13:00'> 13:00 </option>
    <option value='14:00'> 14:00 </option>
    <option value='15:00'> 15:00 </option>
    <option value='16:00'> 16:00 </option>
    <option value='17:00'> 17:00 </option>
    </select><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop