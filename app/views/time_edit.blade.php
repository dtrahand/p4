@extends('_master')

@section('title')
	Available times
@stop

@section('h1-title')
    <h1>Change available days and times</h1>
@stop

@section('content')

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

<table>
<tbody>
    <tr>
    {{ Form::open(array(
            'method'=>'POST', 
            'url' => array('/time/edit', $usertime->id) )) }}
        
    <td class="box">
        {{ Form::label('Day - ') }}
        {{$usertime->Day}}
        <select name="Day" class="form-control input-lg" value="">
        <option value=''>  </option>
        <option value='Monday'> Monday </option>
        <option value='Tuesday'> Tuesday </option>
        <option value='Wednesday'> Wednesday </option>
        <option value='Thursday'> Thursday </option>
        <option value='Friday'> Friday </option>
        <option value='Saturday'> Saturday </option>
        <option value='Sunday'> Sunday </option>
        </select>
    </td>
    <td class="box">
        {{ Form::label('Start - ') }}
        {{$usertime->Start}}
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
        {{ Form::label('End  - ') }} 
        {{$usertime->End}}
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

<p></p>

<div>
    <!-- ---- DELETE ----- -->
    {{ Form::open(array(
        'url' => array('/time/destroy', $usertime->id),
        'method' => 'GET')) }}
        {{ Form::submit('Delete') }}
    {{ Form::close() }}
</div>

@stop