@extends('template')

@section('main')
<div id="jurnalumum" class="panel panel-default">
	<div class="panel-heading"><b><h4>Jurnal Umum</h4></b></div>
	<div class="panel-body">
	@include('jurnalumum.form_pencarian')
	@if (count($daftarjurnal) > 0)
	<table class="table table-bordered">
		<thead>
			<tr align="center">
				<td><b>Tanggal</td>
				<td><b>Keterangan</td>	
				<td><b>Debet</td>
				<td><b>Kredit</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($daftarjurnal as $jurnal): ?>
			<tr align="center"> 
				<td>{{ $jurnal->tanggal }}</td>
				@if($jurnal->status == 'debit')
				<td align="left">{{ $jurnal->keterangan }}</td>
				<td align="right">{{ $jurnal->nominal }}</td><td></td>
				@elseif($jurnal->status == 'kredit')
				<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				{{ $jurnal->keterangan }}</td>
				<td></td><td align="right">{{ $jurnal->nominal }}</td>
				@endif
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data transaksi.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Transaksi : {{ $jumlahjurnal  }}</strong>
	</div>
	
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop