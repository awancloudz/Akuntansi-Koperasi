@extends('template')

@section('main')
<div id="nilaikuesioner" class="panel panel-default">
	<div class="panel-heading"><b><h4>Kuesioner Penilaian Aspek Manajemen</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<!--@include('kuesioner.form_pencarian')
	<div class="tombol-nav">
		{{ link_to('nilaikuesioner/create','Tambah Data Kuesioner',['class' => 'btn btn-primary']) }}
	</div>--><br><br>
	@if (count($daftarnilai) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Deskripsi</th>
				<th>Grup Aspek Kuesioner</th>				
				<th>Pilihan (Ya/Tidak)</th>
				<th>Nilai</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$nilaitotal=0; 
			?>
			@foreach($daftarnilai as $nilaikuesioner)
			<tr>
				<td align="justify">{{ $nilaikuesioner->kuesioner->deskripsi}}</td>
				<td align="center">{{ $nilaikuesioner->kuesioner->aspekgrup->nama_aspekgrup }}</td>	
				<td align="center"><?php echo strtoupper($nilaikuesioner->pilihan); ?></td>	
				@if($nilaikuesioner->pilihan == 'ya')
				<td>1</td><?php $nilaitotal = $nilaitotal + 1; ?>
				@elseif($nilaikuesioner->pilihan == 'tidak')
				<td>0</td><?php $nilaitotal = $nilaitotal + 0; ?>
				@endif
				<td>
				<div class="box-button">
					{{ link_to('nilaikuesioner/' . $nilaikuesioner->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
				</div>
				</td>	
			</tr>
			@endforeach
			<tr><td colspan="3" align="right"><b>Nilai Total</td><td>{{ $nilaitotal }}</td></tr>
		</tbody>
	</table>
	@else
	<p>Tidak ada data kuesioner.</p>
	@endif
	</div>
</div>
@stop

@section('footer')
	@include('footer')
@stop