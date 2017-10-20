@extends('template')

@section('main')
	<div id="transaksiumum" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Transaksi Umum</h4></b></div>
		<div class="panel-body">
		{!! Form::model($transaksiumum, ['method' => 'PATCH', 'action' => ['TransaksiumumController@update', $transaksiumum->id],'files'=>true]) !!}
		@include('transaksiumum.form', ['submitButtonText' => 'Update Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop