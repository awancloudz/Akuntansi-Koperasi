@extends('template')

@section('main')
<div id="laporan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Simpanan Nasabah</h4></b></div>
	<div class="panel-body">
	@include('laporan.form_pencarian_simpanan')
	@if (count($daftarsimpanan) > 0)
	<table class="table table-bordered">
		<thead>
			<th>Kode Transaksi</th>
			<th>Id Akun</th>
			<th>Nama Nasabah</th>
			<th>Tanggal</th>
			<th>Jenis Simpanan</th>	
			<th>Debet</th>
			<th>Kredit</th>
			<th>Saldo</th>
		</thead>
		<tbody>
		<?php $saldo=0; ?>
		<?php foreach($daftarsimpanan as $simpanan): ?>
		<tr align="center">
			<td>{{ $simpanan->kodetransaksi }}</td>
			<td>{{ $simpanan->akun->nama_akun }}</td>
			<td>{{ $simpanan->nasabah->nama }}</td>
			<td>{{ $simpanan->tanggal }}</td>
			<td>{{ $simpanan->jenis_simpanan }}</td>
			@if($simpanan->status == 'debit')
			<?php $saldo = $saldo + $simpanan->nominal_simpan ?>
			<td align="right">{{ $simpanan->nominal_simpan }}</td><td></td>
			@elseif($simpanan->status == 'kredit')
			<?php $saldo = $saldo - $simpanan->nominal_simpan ?>
			<td></td><td align="right">{{ $simpanan->nominal_simpan }}</td>
			@endif
			<td align="right">{{ $saldo }}</td>
		</tr>
		<?php endforeach ?>
		<tr><td colspan="6"></td><td align="right"><b>Saldo Akhir</td><td align="right">{{ $saldo }}</td></tr>
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