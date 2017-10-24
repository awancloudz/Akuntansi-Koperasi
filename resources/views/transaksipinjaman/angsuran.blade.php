@extends('template')

@section('main')
<div id="transaksipinjaman" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Detail Angsuran</h4></b></div>
	<div class="panel-body">
    @include('_partial.flash_message')
	@if (count($daftarangsuran) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Angsuran</th>
				<th>Jasa Uang</th>
				<th>Total Bayar</th>
				<th>Saldo</th>	
				<th>Jatuh Tempo</th>
				<th>Tanggal Bayar</th>
                <th>Status Bayar</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarangsuran as $angsuran): ?>
			<tr>
				<td>{{ $angsuran->angsuran }}</td>
				<td>{{ $angsuran->jasa_uang }}</td>
				<td>{{ $angsuran->total_bayar }}</td>
				<td>{{ $angsuran->saldo }}</td>
				<td>{{ $angsuran->jatuh_tempo }}</td>	
				<td>{{ $angsuran->tanggal_bayar }}</td>
                <td>{{ $angsuran->status_bayar }}</td>	
				<td>
                    @if($angsuran->status_bayar == 'belum')
                    {!! Form::model($angsuran, ['method' => 'PATCH', 'action' => ['TransaksipinjamanController@bayar', $angsuran->id]]) !!}
					{!! Form::hidden('id', $angsuran->id) !!}
                    <?php $sekarang = date("Y-m-d"); ?>
                    {!! Form::hidden('tanggal_bayar', $sekarang) !!}
                    {!! Form::hidden('status_bayar', 'sudah') !!}
                    {!! Form::submit('Bayar', ['class' => 'btn btn-success btn-sm'])!!}
                    {!! Form::close() !!}
                    @endif
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data angsuran.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Transaksi : {{ $jumlahangsuran}}</strong>
	</div>
	
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop