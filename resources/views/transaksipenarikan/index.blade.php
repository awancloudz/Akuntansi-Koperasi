@extends('template')

@section('main')
<div id="transaksisimpanan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Transaksi Penarikan</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('transaksipenarikan.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('transaksipenarikan/create','Tambah Penarikan',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftarsimpanan) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Kode Transaksi</th>
				<th>Id Akun</th>
				<th>Nama Nasabah</th>
				<th>Tanggal</th>
				<th>Jenis Simpanan</th>	
				<th>Nominal</th>	
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarsimpanan as $simpanan): ?>
			<tr>
				<td>{{ $simpanan->kodetransaksi }}</td>
				<td>{{ $simpanan->akun->nama_akun }}</td>
				<td>{{ $simpanan->nasabah->nama }}</td>
				<td>{{ $simpanan->tanggal }}</td>
				<td>{{ $simpanan->jenis_simpanan }}</td>	
				<td>{{ $simpanan->nominal_simpan }}</td>	
				<td>
					<div class="box-button">
					{{ link_to('transaksipenarikan/' . $simpanan->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['TransaksipenarikanController@destroy',$simpanan->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data penarikan.</p>
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