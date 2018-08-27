@extends('template')

@section('main')
	<div id="akun" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Akun</h4></b></div>
		<div class="panel-body">
		{!! Form::model($akun, ['method' => 'PATCH', 'action' => ['AkunController@update', $akun->id],'files'=>true]) !!}
		@include('akun.form', ['submitButtonText' => 'Update Akun'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop