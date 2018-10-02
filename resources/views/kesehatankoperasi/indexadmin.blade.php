@extends('template')

@section('main')
<div id="kesehatankoperasi" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Penilaian Kesehatan Koperasi</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<!-- <div class="tombol-nav">
		{{ link_to('kesehatankoperasi/create','Tambah Aspek',['class' => 'btn btn-primary']) }}
	</div><br><br><br> -->
	@if (count($daftaruser) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>No Badan Hukum</th>
				<th>Nama Koperasi</th>				
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftaruser as $user): ?>
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->no_badan_hukum }}</td>
				<td>{{ $user->name }}</td>				
				<td>
					<div class="box-button">
					{{ link_to('penilaiankesehatan/' . $user->id , 'Detail Penilaian', ['class' => 'btn btn-success btn-sm']) }}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data koperasi.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Koperasi : {{ $jumlahuser }}</strong>
	</div>
	<div class="paging">
	{{ $daftaruser->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop