@extends('template')

@section('main')
	<div id="produk" class="panel panel-default">
		<div class="panel-heading"><b><h4>Ubah Produk</h4></b></div>
		<div class="panel-body">
		{!! Form::model($produk, ['method' => 'PATCH', 'action' => ['ProdukController@update', $produk->id],'files'=>true]) !!}
		@include('produk.form', ['submitButtonText' => 'Update Produk'])
		{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop