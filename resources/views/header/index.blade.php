@extends('template')

@section('main')
<div id="header" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Header</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('header.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('header/create','Tambah Header',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftarheader) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Kode Header</th>
				<th>Nama Header</th>				
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarheader as $header): ?>
			<tr>
				<td>{{ $header->kode_header }}</td>
				<td>{{ $header->nama_header }}</td>				
				<td>
					<div class="box-button">
					{{ link_to('header/' . $header->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['HeaderController@destroy',$header->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data header.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Header : {{ $jumlahheader}}</strong>
	</div>
	<div class="paging">
	{{ $daftarheader->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop