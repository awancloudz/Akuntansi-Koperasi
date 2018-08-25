@extends('template')

@section('main')
	<div id="kuesioner" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Kuesioner</h4></b></div>
		<div class="panel-body">
		{!! Form::model($kuesioner, ['method' => 'PATCH', 'action' => ['KuesionerController@update', $kuesioner->id],'files'=>true]) !!}
		@include('akun.form', ['submitButtonText' => 'Update Kuesioner'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop