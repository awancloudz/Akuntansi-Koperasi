@extends('template')

@section('main')
	<div id="aspekgrup" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Aspek Kuesioner</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'aspekgrup', 'files' => true]) !!}
		@include('aspekgrup.form', ['submitButtonText' => 'Simpan Aspek'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop