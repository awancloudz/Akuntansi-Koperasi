@extends('template')

@section('main')
<div id="transaksisimpanan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Transaksi Simpanan - {{ $nasabah->nama }}</h4></b></div>
	<div class="panel-body">
	<div class="tombol-nav">
		{{ link_to('transaksisimpanan/create','Tambah Simpanan',['class' => 'btn btn-primary']) }}
		{{ link_to('transaksisimpanan/cetak','Cetak Simpanan',['class' => 'btn btn-success']) }}
	</div><br><br><br>
	@if (count($daftarsimpanan) > 0)
	<table class="table">
		<thead>
			<tr align="center"> 
				<td><b>Kode Transaksi</td>
				<td><b>Id Akun</td>
				<td><b>Tanggal</td>
				<td><b>Jenis Simpanan</th>	
				<td align="right"><b>Debit</td>	
				<td align="right"><b>Kredit</td>
				<td align="right"><b>Saldo</td>
			</tr>
		</thead>
		<tbody>
			<?php $saldo=0; ?>
			<?php foreach($daftarsimpanan as $simpanan): ?>
			<tr align="center">
				<td>{{ $simpanan->kodetransaksi }}</td>
				<td>{{ $simpanan->akun->nama_akun }}</td>
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
		<tr><td colspan="5"></td><td align="right"><b>Saldo Akhir</td><td align="right">{{ $saldo }}</td></tr>
		</tbody>
	</table>
	@else
	<p>Tidak ada data simpanan.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Transaksi : {{ $jumlahsimpanan}}</strong>
	</div>
	
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop