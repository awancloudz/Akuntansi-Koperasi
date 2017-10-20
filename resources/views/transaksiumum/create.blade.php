@extends('template')

@section('main')
	<div id="transaksiumum" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Transaksi Umum</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'transaksiumum', 'files' => true]) !!}
		@include('transaksiumum.form', ['submitButtonText' => 'Simpan Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop