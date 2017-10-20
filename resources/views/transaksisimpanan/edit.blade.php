@extends('template')

@section('main')
	<div id="transaksisimpanan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Transaksi Simpanan</h4></b></div>
		<div class="panel-body">
		{!! Form::model($transaksisimpanan, ['method' => 'PATCH', 'action' => ['TransaksisimpananController@update', $transaksisimpanan->id],'files'=>true]) !!}
		@include('transaksisimpanan.form', ['submitButtonText' => 'Update Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop