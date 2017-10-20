@extends('template')

@section('main')
	<div id="transaksisimpanan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Transaksi Simpanan</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'transaksisimpanan', 'files' => true]) !!}
		@include('transaksisimpanan.form', ['submitButtonText' => 'Simpan Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop