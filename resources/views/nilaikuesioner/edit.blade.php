@extends('template')

@section('main')
	<div id="nilaikuesioner" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Kuesioner Penilaian Aspek Manajemen</h4></b></div>
		<div class="panel-body">
		{!! Form::model($nilaikuesioner, ['method' => 'PATCH', 'action' => ['NilaiKuesionerController@update', $nilaikuesioner->id],'files'=>true]) !!}
		@include('nilaikuesioner.form', ['submitButtonText' => 'Update Kuesioner'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop