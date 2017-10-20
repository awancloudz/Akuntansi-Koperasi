@extends('template')

@section('main')
	<div id="nasabah" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Nasabah</h4></b></div>
		<div class="panel-body">
		{!! Form::model($nasabah, ['method' => 'PATCH', 'action' => ['NasabahController@update', $nasabah->id],'files'=>true]) !!}
		@include('nasabah.form', ['submitButtonText' => 'Update Nasabah'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop