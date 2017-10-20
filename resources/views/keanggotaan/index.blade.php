@extends('template')

@section('main')
<div id="keanggotaan" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Keanggotaan</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('keanggotaan.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('keanggotaan/create','Tambah Keanggotaan',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftarkeanggotaan) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Nama Keanggotaan</th>
				<th>Simpanan Pokok</th>
				<th>Simpanan Wajib</th>
				<th>Bunga Simpanan</th>	
				<th>Bunga Pinjaman</th>	
				<th>Denda Pinjaman</th>	
				<th>Keterangan</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarkeanggotaan as $keanggotaan): ?>
			<tr>
				<td>{{ $keanggotaan->nama_keanggotaan }}</td>
				<td>{{ $keanggotaan->simpanan_pokok}}</td>
				<td>{{ $keanggotaan->simpanan_wajib }}</td>
				<td>{{ $keanggotaan->bunga_simpanan }}</td>	
				<td>{{ $keanggotaan->bunga_pinjaman }}</td>	
				<td>{{ $keanggotaan->denda_pinjaman }}</td>
				<td>{{ $keanggotaan->keterangan }}</td>		
				<td>
					<div class="box-button">
					{{ link_to('keanggotaan/' . $keanggotaan->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['KeanggotaanController@destroy',$keanggotaan->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data keanggotaan.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Keanggotan : {{ $jumlahkeanggotaan}}</strong>
	</div>
	
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop