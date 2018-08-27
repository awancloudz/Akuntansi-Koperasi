@extends('template')

@section('main')
<div id="kesehatankoperasi" class="panel panel-default">
	<div class="panel-heading"><b><h4>Data Penilaian Kesehatan Koperasi</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	@include('kesehatankoperasi.form_pencarian')
	<!--<div class="tombol-nav">
		{{ link_to('kesehatankoperasi/create','Tambah Akun',['class' => 'btn btn-primary']) }}
	</div><br><br>
	<form style="border: 2px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
		<input type="file" name="import_file" /><br>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button class="btn btn-success">Import File Excel</button>
	</form>
	<br><br><br>-->
	@if (count($daftaruser) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>No.Badan Hukum</th>
				<th>Nama Koperasi</th>			
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftaruser as $user): ?>
			<tr>
				<td>{{ $user->no_badan_hukum}}</td>
				<td>{{ $user->name }}</td>			
				<td>
					<div class="box-button">
					{{ link_to('kesehatankoperasi/' . $user->id , 'Detail Penilaian', ['class' => 'btn btn-success btn-sm']) }}
					</div>
					<div class="box-button">
					{{ link_to('kesehatankoperasi/cetak/' . $user->id,'Cetak',['class' => 'btn btn-primary btn-sm','target'=>'_blank']) }}
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
		<strong>Jumlah Koperasi : {{ $jumlahuser}}</strong>
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