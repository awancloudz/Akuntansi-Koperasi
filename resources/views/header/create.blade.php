@extends('template')

@section('main')
	<div id="header" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Kategori</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'header', 'files' => true]) !!}
		@include('header.form', ['submitButtonText' => 'Simpan Kategori'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop