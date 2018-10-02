@extends('template')

@section('main')
<div id="kesehatankoperasi" class="panel panel-default">
	<div class="panel-heading"><b><h4>Laporan Penilaian Kesehatan Koperasi - Koperasi {{ $user->name }}</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<!--@include('kuesioner.form_pencarian')-->
	<div class="tombol-nav">
		{{ link_to('penilaiankesehatan/cetak','Cetak Data Penilaian',['class' => 'btn btn-success']) }}
	</div><br><br>
	@if (count($daftargrup) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Aspek</th>
				<td align="center"><b>Nama Komponen</td>
				<th>Persentase</th>
				<th>Nilai Kredit</th>
				<th>Bobot Penilaian</th>
				<th>Skor</th>
				<!-- <th>Action</th> -->
			</tr>
		</thead>
		<tbody>
		
		<?php 
		/* Fungsi Romawi */
		$romawi = 0; 
		$nilaitotal = 0;
		function numberToRomanRepresentation($number) {
			$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
			$returnValue = '';
			while ($number > 0) {
				foreach ($map as $roman => $int) {
					if($number >= $int) {
						$number -= $int;
						$returnValue .= $roman;
						break;
					}
				}
			}
			return $returnValue;
		}
		?>

		@foreach($daftargrup as $grup)
			<tr><td colspan="6" align="left"><b>
			<?php $romawi = $romawi + 1; echo numberToRomanRepresentation($romawi) . ".";?>
			{{ $grup->aspekpenilaian->nama_aspekpenilaian }}
			</td></tr>
			<?php $i = 0; ?>
			@foreach($daftarnilai as $nilaikesehatan)
			@if($grup->aspekpenilaian->id == $nilaikesehatan->id_aspekpenilaian)
			<tr>
				<td align="right"><?php $i = $i + 1; echo $i . "."; ?></td>
				<td align="justify">{{ $nilaikesehatan->komponenpenilaian->komponen}}</td>	
				<td align="center">{{ $nilaikesehatan->persen }}</td>	
				<td align="center">{{ $nilaikesehatan->nilaikredit }}</td>
				<td align="center">{{ $nilaikesehatan->komponenpenilaian->bobot }} %</td>
				<td align="center">{{ $nilaikesehatan->skor }}</td>
				<!--<td>
				<div class="box-button">
					{{ link_to('kesehatankoperasi/' . $nilaikesehatan->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
				</div>
				</td>-->
			</tr>
			@endif
			@endforeach
		@endforeach
			<tr><td colspan="4"></td><td align="center"><b>Skor Total</td><td align="center">{{ $nilaitotal }}</td></tr>
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