@extends('template')

@section('main')
<div id="akun" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Akun</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('akun.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('akun/create','Tambah Akun',['class' => 'btn btn-primary']) }}
	</div><br><br>
	<!--<form style="border: 2px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		<input type="file" name="import_file" /><br>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button class="btn btn-success">Import File Excel</button>
	</form>
	<br><br><br>-->
	@if (count($daftarakun) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Kode Akun</th>
				<th>Nama Akun</th>
				<th>Grup Kategori</th>				
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarakun as $akun): ?>
			<tr>
				<td>{{ $akun->kode_akun}}</td>
				<td>{{ $akun->nama_akun }}</td>
				<td>{{ $akun->header->nama_header }}</td>				
				<td>
					<div class="box-button">
					{{ link_to('akun/' . $akun->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
					</div>
					<div class="box-button">
					{!! Form::open(['method' => 'DELETE', 'action' => ['AkunController@destroy',$akun->id]]) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])!!}
					{!! Form::close()!!}
					</div>
				</td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data akun.</p>
	@endif
	<div class="table-nav">
	<div class="jumlah-data">
		<strong>Jumlah Akun : {{ $jumlahakun}}</strong>
	</div>
	<div class="paging">
	{{ $daftarakun->links() }}
	</div>
	</div>

	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop