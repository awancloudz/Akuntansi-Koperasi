@extends('template')

@section('main')
	<div id="aspekgrup" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Aspek Kuesioner</h4></b></div>
		<div class="panel-body">
		{!! Form::model($aspekgrup, ['method' => 'PATCH', 'action' => ['AspekController@update', $aspekgrup->id],'files'=>true]) !!}
		@include('aspekgrup.form', ['submitButtonText' => 'Update Aspek'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop