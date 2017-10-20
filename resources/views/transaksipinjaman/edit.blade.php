@extends('template')

@section('main')
	<div id="transaksipinjaman" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Transaksi Pinjaman</h4></b></div>
		<div class="panel-body">
		{!! Form::model($transaksipinjaman, ['method' => 'PATCH', 'action' => ['TransaksipinjamanController@update', $transaksipinjaman->id],'files'=>true]) !!}
		@include('transaksipinjaman.form', ['submitButtonText' => 'Update Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop