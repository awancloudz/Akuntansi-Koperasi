@extends('template')

@section('main')
<div id="laporan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Pinjaman Nasabah</h4></b></div>
	<div class="panel-body">
	@include('laporan.form_pencarian_pinjaman')
	@if (count($daftarpinjaman) > 0)
	<table class="table table-bordered">
		<tr align="center">
			<td><b>Kode Transaksi</td>
			<td><b>Id Akun</td>
			<td><b>Nama Nasabah</td>
			<td><b>Tanggal</td>
			<td><b>Nominal Pinjam</td>	
			<td><b>Kali Angsuran</td>
			<td><b>Nominal Angsuran</td>
		</tr>
		<tbody>
		<?php foreach($daftarpinjaman as $pinjaman): ?>
		<tr align="center">
			<td>{{ $pinjaman->kodetransaksi }}</td>
			<td>{{ $pinjaman->akun->nama_akun }}</td>
			<td>{{ $pinjaman->nasabah->nama }}</td>
			<td>{{ $pinjaman->tanggal }}</td>
			<td align="right">{{ $pinjaman->nominal_pinjam }}</td>
			<td>{{ $pinjaman->kali_angsuran }}</td>	
			<td align="right">{{ $pinjaman->nominal_angsuran }}</td>	
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data transaksi.</p>
	@endif
	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop