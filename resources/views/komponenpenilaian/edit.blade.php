@extends('template')

@section('main')
	<div id="komponenpenilaian" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Komponen Penilaian</h4></b></div>
		<div class="panel-body">
		{!! Form::model($komponenpenilaian, ['method' => 'PATCH', 'action' => ['KomponenPenilaianController@update', $komponenpenilaian->id],'files'=>true]) !!}
		@include('komponenpenilaian.form', ['submitButtonText' => 'Update Komponen'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop