@extends('template')

@section('main')
<div id="transaksiumum" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Transaksi Umum</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('transaksiumum.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('transaksiumum/create','Tambah Transaksi',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftarumum) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Kode Transaksi</th>
				<th>Id Akun</th>
				<th>Tanggal</th>
				<th>Nominal Transaksi</th>	
				<th>Keterangan</th>	
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarumum as $umum): ?>
			<tr>
				<td>{{ $umum->kodetransaksi }}</td>
				<td>{{ $umum->akun->nama_akun }}</td>
				<td>{{ $umum->tanggal }}</td>
				<td>{{ $umum->nominal }}</td>
				<td>{{ $umum->keterangan }}</td>	
				<td>
					<div class="box-button">
					{{ link_to('transaksiumum/' . $umum->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['TransaksiumumController@destroy',$umum->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data transaksi.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Transaksi : {{ $jumlahumum }}</strong>
	</div>
	
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop