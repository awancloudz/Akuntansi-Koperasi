@extends('template')

@section('main')
<div id="aspekgrup" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Grup Aspek Kuesioner</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<div class="tombol-nav">
		{{ link_to('aspekgrup/create','Tambah Aspek',['class' => 'btn btn-primary']) }}
	</div><br><br><br>
	@if (count($daftaraspek) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Aspek Kuesioner</th>				
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftaraspek as $aspekgrup): ?>
			<tr>
				<td>{{ $aspekgrup->id }}</td>
				<td>{{ $aspekgrup->nama_aspekgrup }}</td>			
				<td>
					<div class="box-button">
					{{ link_to('aspekgrup/' . $aspekgrup->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['AspekController@destroy',$aspekgrup->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data aspek grup kuesioner.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Aspek : {{ $jumlahaspek}}</strong>
	</div>
	<div class="paging">
	{{ $daftaraspek->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop