@extends('template')

@section('main')
<div id="laporan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Sisa Hasil Usaha</h4></b></div>
	<div class="panel-body">
	@include('laporan.form_pencarian_shu')
	@if (count($daftarshu_) > 0)
	<table class="table table-bordered">
	<tr>
		<td coslpan="3"><b># Partisipasi Bruto Anggota : </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Partisipasi Jasa Pinjaman</td><td align="right">{{ $pinjaman }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Partisipasi Jasa Provisi</td><td align="right">{{ $provisi }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Partisipasi Bruto</td><td></td><td align="right">{{ $bruto }}</td>
	</tr>
	<tr>
		<td coslpan="3"><b># Beban Pokok : </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Beban Bunga </td><td></td><td align="right">{{ $beban }}</td>
	</tr>
	<tr>
		<td><b># Partisipasi Netto Anggota : </b></td><td></td><td align="right"><b>{{ $netto }}</b></td>
	</tr>
	<tr>
		<td coslpan="3"><br><b># Beban Operasi : </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Gaji</td><td align="right">{{ $gaji }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Beban Penyusutan Peralatan</td><td align="right">{{ $penyusutan }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Beban Pemakaian Perlengkapan</td><td align="right">{{ $pemakaian }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Beban Operasi</td><td></td><td align="right">{{ $operasi }}</td>
	</tr>
	<tr>
		<td><b># Sisa Hasil Usaha : </b></td><td></td><td align="right"><b>{{ $shutotal }}</b></td>
	</tr>
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