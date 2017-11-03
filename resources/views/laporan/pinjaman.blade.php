@extends('template')

@section('main')
<div id="laporan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Pinjaman Nasabah</h4></b></div>
	<div class="panel-body">
	@include('laporan.form_pencarian_pinjaman')
	@if (count($daftarpinjaman) > 0)
	<table class="table table-bordered">
		<thead>
			<th>Kode Transaksi</th>
			<th>Id Akun</th>
			<th>Nama Nasabah</th>
			<th>Tanggal</th>
			<th>Nominal Pinjam</th>	
			<th>Kali Angsuran</th>
			<th>Nominal Angsuran</th>
			<th>Saldo</th>
		</thead>
		<tbody>
		<?php foreach($daftarpinjaman as $pinjaman): ?>
		<tr>
			<td>{{ $pinjaman->kodetransaksi }}</td>
			<td>{{ $pinjaman->akun->nama_akun }}</td>
			<td>{{ $pinjaman->nasabah->nama }}</td>
			<td>{{ $pinjaman->tanggal }}</td>
			<td>{{ $pinjaman->nominal_pinjam }}</td>
			<td>{{ $pinjaman->kali_angsuran }}</td>	
			<td>{{ $pinjaman->nominal_angsuran }}</td>	
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data transaksi.</p>
	@endif
	<div class="table-nav">
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop