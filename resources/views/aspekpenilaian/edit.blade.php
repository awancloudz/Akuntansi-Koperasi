@extends('template')

@section('main')
	<div id="aspekpenilaian" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Aspek Penilaian Kesehatan</h4></b></div>
		<div class="panel-body">
		{!! Form::model($aspekpenilaian, ['method' => 'PATCH', 'action' => ['AspekPenilaianController@update', $aspekpenilaian->id],'files'=>true]) !!}
		@include('aspekpenilaian.form', ['submitButtonText' => 'Update Aspek'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop