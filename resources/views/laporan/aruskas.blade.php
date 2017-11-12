@extends('template')

@section('main')
<div id="laporan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Arus Kas Koperasi</h4></b></div>
	<div class="panel-body">
	@include('laporan.form_pencarian_aruskas')
	@if (count($daftararuskas) > 0)
	<table class="table table-bordered">
	<tr>
		<td><b>SHU </b></td><td align="right">{{ $shutotal }}</td><td></td>
	</tr>
	<tr>
		<td colspan="3"><b>Penyesuaian :</b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Kenaikan Piutang Anggota</td><td align="right">{{ $piutang }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Kenaikan Hutang Jangka Pendek</td><td align="right">{{ $hutangpendek }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Pemakaian Perlengkapan</td><td align="right">{{ $pemakaian }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Beban Penyusutan</td><td align="right">{{ $penyusutan }}</td><td></td>
	</tr>
	<tr>
		<td>Kas Bersih dari aktivitas operasi</b></td><td></td><td align="right"><b>{{ $totaloperasi }}</b></td>
	</tr>
	<tr>
		<td colspan="3"><b>Arus Kas dari Investasi :</b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Pembelian Perlengkapan</td><td align="right">{{ $perlengkapan }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Pembelian Peralatan</td><td align="right">{{ $peralatan }}</td><td></td>
	</tr>
	<tr>
		<td>Arus Kas dari aktivitas investasi</b></td><td></td><td align="right"><b>{{ $totalinvestasi }}</b></td>
	</tr>
	<tr>
		<td colspan="3"><b>Arus Kas dari aktivitas Pembiayaan :</b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Kredit Bank</td><td align="right">{{ $hutangbank }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Simpanan Pokok</td><td align="right">{{ $simpananpokok }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Simpanan Wajib</td><td align="right">{{ $simpananwajib }}</td><td></td>
	</tr>
	<tr>
		<td>Arus Kas dari aktivitas pembiayaan</b></td><td></td><td align="right"><b>{{ $totalpembiayaan }}</b></td>
	</tr>
	<tr>
		<td><b>Kas Awal Periode </b></td><td></td><td align="right"><b>0</b></td>
	</tr>
	<tr>
		<td><b>Kas Akhir Periode </b></td><td></td><td align="right"><b>{{ $kasakhir }}</b></td>
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