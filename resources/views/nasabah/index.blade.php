@extends('template')

@section('main')
<div id="nasabah" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Nasabah</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('nasabah.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('nasabah/create','Tambah Nasabah',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftarnasabah) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>No.Nasabah</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>No.Handphone</th>	
				<th>Keanggotaan</th>	
				<th>Tanggal Masuk</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarnasabah as $nasabah): ?>
			<tr>
				<td>{{ $nasabah->no_nasabah }}</td>
				<td>{{ $nasabah->nama}}</td>
				<td>{{ $nasabah->alamat }}</td>
				<td>{{ $nasabah->no_hp }}</td>	
				<td>{{ $nasabah->keanggotaan->nama_keanggotaan }}</td>	
				<td>{{ $nasabah->tanggal_masuk }}</td>	
				<td>
					<div class="box-button">
					{{ link_to('nasabah/simpanan/' . $nasabah->id, 'Simpanan', ['class' => 'btn btn-success btn-sm']) }}
					<div class="box-button">
					{{ link_to('nasabah/penarikan/' . $nasabah->id, 'Penarikan', ['class' => 'btn btn-default btn-sm']) }}
					<div class="box-button">
					{{ link_to('nasabah/pinjaman/' . $nasabah->id, 'Pinjaman', ['class' => 'btn btn-primary btn-sm']) }}
					<div class="box-button">
					{{ link_to('nasabah/' . $nasabah->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['NasabahController@destroy',$nasabah->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data nasabah.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Nasabah : {{ $jumlahnasabah}}</strong>
	</div>
	<div class="paging">
	{{ $daftarnasabah->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop