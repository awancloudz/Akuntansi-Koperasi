@extends('template')

@section('main')
	<div id="kuesioner" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Kuesioner</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'kuesioner', 'files' => true]) !!}
		@include('kuesioner.form', ['submitButtonText' => 'Simpan Kuesioner'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop