@extends('template')

@section('main')
	<div id="aspekpenilaian" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Aspek Penilaian Kesehatan</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'aspekpenilaian', 'files' => true]) !!}
		@include('aspekpenilaian.form', ['submitButtonText' => 'Simpan Aspek'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop