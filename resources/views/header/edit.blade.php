@extends('template')

@section('main')
	<div id="header" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Kategori</h4></b></div>
		<div class="panel-body">
		{!! Form::model($header, ['method' => 'PATCH', 'action' => ['HeaderController@update', $header->id],'files'=>true]) !!}
		@include('header.form', ['submitButtonText' => 'Update Kategori'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop