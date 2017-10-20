@extends('template')

@section('main')
	<div id="produk" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Produk</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'produk', 'files' => true]) !!}
		@include('produk.form', ['submitButtonText' => 'Simpan Produk'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop