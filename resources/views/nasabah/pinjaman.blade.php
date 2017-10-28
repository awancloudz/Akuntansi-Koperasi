@extends('template')

@section('main')
<div id="transaksipinjaman" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Transaksi Pinjaman - {{ $nasabah->nama }}</h4></b></div>
	<div class="panel-body">
	<div class="tombol-nav">
		{{ link_to('transaksipinjaman/create','Tambah Pinjaman',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftarpinjaman) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Kode Transaksi</th>
				<th>Id Akun</th>
				<th>Tanggal</th>
				<th>Nominal Pinjam</th>	
				<th>Kali Angsuran</th>
				<th>Nominal Angsuran</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarpinjaman as $pinjaman): ?>
			<tr>
				<td>{{ $pinjaman->kodetransaksi }}</td>
				<td>{{ $pinjaman->akun->nama_akun }}</td>
				<td>{{ $pinjaman->tanggal }}</td>
				<td>{{ $pinjaman->nominal_pinjam }}</td>
				<td>{{ $pinjaman->kali_angsuran }}</td>	
				<td>{{ $pinjaman->nominal_angsuran }}</td>	
				<td>
					<div class="box-button">
					{{ link_to('transaksipinjaman/angsuran/' . $pinjaman->id , 'Detail Angsuran', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{{ link_to('transaksipinjaman/cetakangsuran/' . $pinjaman->id,'Cetak Angsuran',['class' => 'btn btn-success btn-sm','target'=>'_blank']) }}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data pinjaman.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Transaksi : {{ $jumlahpinjaman}}</strong>
	</div>
	
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop