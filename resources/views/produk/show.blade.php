@extends('template')
@section('main')
<div id="produk" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Produk</h4></b></div>
	<div class="panel-body">
		<table class="table table-striped">
		<?php 
			function rupiah($nilai, $pecahan = 0) {
			return "Rp. " . number_format($nilai, $pecahan, ',', '.');
			} 
		?>
		<tr><th>Kode Produk</th><td>{{ $produk->kodeproduk }}
		<?php
			echo DNS1D::getBarcodeHTML($produk->kodeproduk, "C128");
		?>
		</td></tr>
		<tr><th>Foto</th>
			<td>
				@if(isset($produk->foto))
				<img width="200" height="200" src="{{ asset('fotoupload/' . $produk->foto) }}">
				@else	
				<img width="200" height="200" src="{{ asset('fotoupload/noimage.png') }}">
				@endif
			</td>
		</tr>
		<tr><th>Nama Produk</th><td>{{ $produk->namaproduk }}</td></tr>
		<tr><th>Seri Produk</th><td>{{ $produk->seriproduk }}</td></tr>
		<tr><th>Kategori</th><td>{{ $produk->kategoriproduk->nama }}</td></tr>
		<tr><th>Bahan</th><td>{{ $produk->jenisproduk }}</td></tr>
		<tr><th>Distributor</th><td>{{ $produk->distributor->nama_distributor }}</td></tr>
		<tr><th>Harga Jual</th><td>{{ rupiah($produk->hargajual) }}</td></tr>
		<tr><th>Harga Grosir</th><td>{{ rupiah($produk->hargagrosir) }}</td></tr>
		<tr><th>Harga Distributor</th><td>{{ rupiah($produk->hargadistributor) }}</td></tr>
		<tr><th>Diskon</th><td>{{ $produk->diskon }} %</td></tr>
		<tr><th>Stok</th><td>{{ $produk->stok }}</td></tr>
		</table>
	</div>
	</div>
</div>
@stop

@section('footer')
@include('footer')
@stop