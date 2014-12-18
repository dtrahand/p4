@extends('_master')

@section('title')
	Grades
@stop

@section('h1-title')
    <h1>Input grades</h1>
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='flash-message'>{{ $message }}</div>
@endforeach

<table>
<tbody>
  <tr>
      {{  Form::open(array(
            'method' => 'post', 
            'action' => array('GradeController@store'))) }}

      <td class="box">
        {{ Form::label('Student') }}<br>
        <select name="student" class="form-control input-lg" value="">
        <option value=''>  </option>
            
        @foreach($students as $student)
            <option value='{{ $student->id }}'> {{ $student->Firstname, " ", $student->Lastname }}</option>
        @endforeach
        </select>

      </td>
      <td class="box">
		{{ Form::label('date','Test Date (yyyy-mm-dd)') }}<br>
		{{ Form::text('date'); }}
    </td> 

      <td class="box">
		{{ Form::label('grade','Grade (%)') }}<br>
		{{ Form::text('grade'); }}
    </td> 
  </tr>
</tbody>
</table>
<br> {{ Form::submit('Submit grade') }}

{{ Form::close() }}

@stop