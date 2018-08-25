@extends('template')

@section('main')
<div id="kuesioner" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Master Kuesioner</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<!--@include('kuesioner.form_pencarian')-->
	<div class="tombol-nav">
		{{ link_to('kuesioner/create','Tambah Data Kuesioner',['class' => 'btn btn-primary']) }}
	</div><br><br>
	@if (count($daftarkuesioner) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Deskripsi</th>
				<th>Grup Aspek Kuesioner</th>				
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarkuesioner as $kuesioner): ?>
			<tr>
				<td>{{ $kuesioner->deskripsi}}</td>
				<td>{{ $kuesioner->aspekgrup->nama_aspekgrup }}</td>				
				<td>
					<div class="box-button">
					{{ link_to('kuesioner/' . $kuesioner->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['KuesionerController@destroy',$kuesioner->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data kuesioner.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Kuesioner : {{ $jumlahkuesioner}}</strong>
	</div>
	<div class="paging">
	{{ $daftarkuesioner->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop