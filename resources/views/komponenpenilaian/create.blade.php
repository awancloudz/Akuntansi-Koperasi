@extends('template')

@section('main')
	<div id="komponenpenilaian" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Komponen Penilaian</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'komponenpenilaian', 'files' => true]) !!}
		@include('komponenpenilaian.form', ['submitButtonText' => 'Simpan Komponen'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop