@extends('template')

@section('main')
	<div id="transaksipenarikan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Transaksi Penarikan</h4></b></div>
		<div class="panel-body">
		{!! Form::model($transaksipenarikan, ['method' => 'PATCH', 'action' => ['TransaksipenarikanController@update', $transaksipenarikan->id],'files'=>true]) !!}
		@include('transaksipenarikan.form', ['submitButtonText' => 'Update Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop