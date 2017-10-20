@extends('template')

@section('main')
	<div id="transaksipinjaman" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Transaksi Pinjaman</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'transaksipinjaman', 'files' => true]) !!}
		@include('transaksipinjaman.form', ['submitButtonText' => 'Simpan Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop