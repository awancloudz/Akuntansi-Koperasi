@extends('template')

@section('main')
<div id="produk" class="panel panel-default">
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="margin-top:100px;">
<div class="modal-dialog">
	<!-- Modal Produk-->
	<div class="modal-content">
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div><b>Impor Excel</b></div>
        </div>
        <div class="modal-body">
        	<form style="border: 2px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
				<input type="file" name="import_file" /><br>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				@if ($mencari == 1)
				<input type="hidden" name="cat1" value="{{ $cat }}">
				@endif
				<button class="btn btn-success">Import File Excel</button>
			</form>
		</div>
	</div>
</div>
</div>
<!-- End Modal -->
<!-- Nama Kategori -->
@if ($mencari == 1)
	@foreach ($kategorinya as $katproduk)
	@if ($katproduk->id == $cat)
	<div class="panel-heading"><b><h4>Data Produk - {{ $katproduk->nama }}</h4></b></div>
	@endif
	@endforeach
@else
	<div class="panel-heading"><b><h4>Data Produk</h4></b></div>
@endif
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('produk.form_pencarian')
	@include('produk.form_pencarian_barcode')
	<div class="tombol-nav">
		{{ link_to('produk/create','Tambah Produk',['class' => 'btn btn-primary']) }}
		<a href="#" id="cmd_import"><button class="btn btn-success">Import Excel</button></a>
		<a href="{{ URL::to('exportExcel/xls') }}"><button class="btn btn-warning">Download Excel .xls</button></a>
		<a href="{{ URL::to('exportExcel/xlsx') }}"><button class="btn btn-warning">Download Excel .xlsx</button></a>
		<a href="{{ URL::to('exportExcel/csv') }}"><button class="btn btn-warning">Download .csv</button></a>
	</div><br><br><br>
	@if (count($produk_list) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Kode Produk</th>
				<th>Nama Produk</th>
				<th>Seri Produk</th>
				<th>Harga Jual</th>
				<th>Harga Grosir</th>
				<th>Harga Distributor</th>
				<th>Diskon</th>
				<th>Stok</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php 
			function rupiah($nilai, $pecahan = 0) {
			return "Rp. " . number_format($nilai, $pecahan, ',', '.');
			} 
			?>
			<?php foreach($produk_list as $produk): ?>
			<tr>
				<td>{{ $produk->kodeproduk }}</td>
				<td>{{ $produk->namaproduk }}</td>
				<td>{{ $produk->seriproduk }}</td>
				<td>{{ rupiah($produk->hargajual) }}</td>
				<td>{{ rupiah($produk->hargagrosir) }}</td>
				<td>{{ rupiah($produk->hargadistributor) }}</td>
				<td>{{ $produk->diskon }} %</td>
				<td>{{ $produk->stok }}</td>
				<td>
					<div class="box-button"> 
					{{ link_to('produk/' . $produk->id,'Detail',['class' => 'btn btn-success btn-sm']) }}</div>
					<div class="box-button">
					{{ link_to('produk/' . $produk->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['ProdukController@destroy',$produk->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
					<div class="box-button"> 
					{{ link_to('produk/print/' . $produk->id,'Cetak',['class' => 'btn btn-primary btn-sm','target'=>'_blank']) }}</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data produk.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Produk : {{ $jumlah_produk}}</strong>
	</div>
	<div class="paging">
	{{ $produk_list->links() }}
	</div>
	</div>

	</div>
</div>
<script>
$(document).ready(function(){
	$("#cmd_import").click(function(){
		$("#myModal").modal({backdrop: "static"});
	});
});
</script>
@stop

@section('footer')
	@include('footer')
@stop