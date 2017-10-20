@extends('template')

@section('main')
	<div id="keanggotaan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Keanggotan</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'keanggotaan', 'files' => true]) !!}
		@include('keanggotaan.form', ['submitButtonText' => 'Simpan Keanggotaan'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop