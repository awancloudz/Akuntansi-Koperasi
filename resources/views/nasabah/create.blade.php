@extends('template')

@section('main')
	<div id="nasabah" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Nasabah</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'nasabah', 'files' => true]) !!}
		@include('nasabah.form', ['submitButtonText' => 'Simpan Nasabah'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop