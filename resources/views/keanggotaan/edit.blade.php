@extends('template')

@section('main')
	<div id="keanggotaan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Keanggotaan</h4></b></div>
		<div class="panel-body">
		{!! Form::model($keanggotaan, ['method' => 'PATCH', 'action' => ['KeanggotaanController@update', $keanggotaan->id],'files'=>true]) !!}
		@include('keanggotaan.form', ['submitButtonText' => 'Update Akun'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop