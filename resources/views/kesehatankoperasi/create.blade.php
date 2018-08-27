@extends('template')

@section('main')
	<div id="akun" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Akun</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'akun', 'files' => true]) !!}
		@include('akun.form', ['submitButtonText' => 'Simpan Akun'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop