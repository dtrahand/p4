@extends('_master')

@section('title')
	Grades
@stop

@section('content')

@foreach($errors->all() as $message)
    <div class='flash-message'>{{ $message }}</div>
@endforeach

<!-- NAME OF STUDENT -->
<!-- *************** -->
@foreach($students as $student)
@if($student->id == $studentgrade->student_id)
    <?php $studentname = $student->Firstname . " " . $student->Lastname; ?>
@endif
@endforeach

@section('h1-title')
<h1>Edit grade information for {{ $studentname }}</h1>
@stop

<table>
<tbody>
      {{  Form::open(array(
            'method' => 'post', 
            'url' => array('/grade/edit', $studentgrade->id) )) }}
      
  <tr>
      <!-- DATE OF GRADE -->
      <!-- ************* -->
      <td class="box">
		{{ Form::label('date','Enter new Test Date (yyyy-mm-dd)') }}<br>
          <p style="color:orange">{{ "Current date: ", $studentgrade->date }}</p>
		{{ Form::text('date'); }}<br>
    </td> 

      <!-- GRADE -->
      <!-- ***** -->
      <td class="box">
		{{ Form::label('grade','Enter new Grade (%)') }}<br>
          <p style="color:orange">{{ "Current grade: ", $studentgrade->grade, " %" }}</p>
		{{ Form::text('grade'); }}<br>
    </td> 
  </tr>
</tbody>
</table>
<br> {{ Form::submit('Update date/grade') }}

{{ Form::close() }}

@stop