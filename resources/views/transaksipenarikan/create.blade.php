@extends('template')

@section('main')
	<div id="transaksipenarikan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Transaksi Penarikan - {{ $nasabah->nama }}</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'transaksipenarikan', 'files' => true]) !!}
		@include('transaksipenarikan.form', ['submitButtonText' => 'Simpan Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop