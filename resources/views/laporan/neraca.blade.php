@extends('template')

@section('main')
<div id="laporan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Neraca</h4></b></div>
	<div class="panel-body">
	@include('laporan.form_pencarian_neraca')
	@if (count($daftarneraca) > 0)
	<table class="table table-bordered">
	<tr>
		<td coslpan="3"><b>Aktiva Lancar </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Kas</td><td align="right">{{ $kas }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Piutang Anggota </td><td align="right">{{ $piutang }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Perlengkapan Kantor </td><td align="right">{{ $pemakaian }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Aktiva Lancar</td><td></td><td align="right">{{ $aktivalancar }}</td>
	</tr>
	<tr>
		<td coslpan="3"><b>Aktiva Tetap</b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Peralatan Kantor</td><td align="right">{{ $peralatan }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Penyusutan</td><td align="right">{{ $penyusutan }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Aktiva Tetap</td><td></td><td align="right">{{ $aktivatetap }}</td>
	</tr>
	<tr>
		<td><b>TOTAL AKTIVA </b></td><td></td><td align="right"><b>{{ $totalaktiva }}</b></td>
	</tr>
	<tr>
		<td coslpan="3"><br><b>Hutang Lancar </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Hutang Usaha</td><td align="right">{{ $hutangusaha }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Simpanan Sukarela</td><td align="right">{{ $simpanansukarela }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Hutang Bunga</td><td align="right">{{ $hutangbunga }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Hutang Lancar</td><td></td><td align="right"><b>{{ $hutanglancar }}</b></td>
	</tr>
	<tr>
		<td coslpan="3"><b>Hutang Jangka Panjang </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Hutang Bank</td><td align="right">{{ $hutangbank }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Hutang Jangka Panjang</td><td></td><td align="right"><b>{{ $hutangjangkapanjang }}</b></td>
	</tr>
	<tr>
		<td coslpan="3"><b>Ekuitas Koperasi </b></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Simpanan Pokok</td><td align="right">{{ $simpananpokok }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - Simpanan Wajib</td><td align="right">{{ $simpananwajib }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; - SHU-Periode Berjalan</td><td align="right">{{ $shutotal }}</td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp; Total Ekuitas Koperasi</td><td></td><td align="right"><b>{{ $ekuitas }}</b></td>
	</tr>
	<tr>
		<td><b>TOTAL PASIVA </b></td><td></td><td align="right"><b>{{ $totalpasiva }}</b></td>
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