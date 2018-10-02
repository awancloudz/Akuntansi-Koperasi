@extends('template')

@section('main')
<div id="komponenpenilaian" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Master Komponen Penilaian</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<!--@include('kuesioner.form_pencarian')-->
	<div class="tombol-nav">
		{{ link_to('komponenpenilaian/create','Tambah Data Komponen',['class' => 'btn btn-primary']) }}
	</div><br><br>
	@if (count($daftarkomponen) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Grup Aspek Penilaian</th>	
				<th>Nama Komponen</th>	
				<th>Bobot</th>		
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarkomponen as $komponenpenilaian): ?>
			<tr>
				<td>{{ $komponenpenilaian->aspekpenilaian->nama_aspekpenilaian}}</td>
				<td>{{ $komponenpenilaian->komponen }}</td>	
				<td>{{ $komponenpenilaian->bobot }} % </td>				
				<td>
					<div class="box-button">
					{{ link_to('komponenpenilaian/' . $komponenpenilaian->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['KomponenPenilaianController@destroy',$komponenpenilaian->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data komponen penilaian.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Komponen Penilaian : {{ $jumlahkomponen}}</strong>
	</div>
	<div class="paging">
	{{ $daftarkomponen->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop