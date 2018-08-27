@extends('template')

@section('main')
<div id="nilaikuesioner" class="panel panel-default">
	<div class="panel-heading"><b><h4>Kuesioner Penilaian Aspek Manajemen</h4></b></div>
	<div class="panel-body">
	@include('_partial.flash_message')
	<!--@include('kuesioner.form_pencarian')-->
	<div class="tombol-nav">
		{{ link_to('nilaikuesioner/cetak','Cetak Data Kuesioner',['class' => 'btn btn-success']) }}
	</div><br><br>
	@if (count($daftargrup) > 0)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ASPEK</th>
				<td align="center"><b>Deskripsi</td>
				<th>Pilihan</th>
				<th>Nilai</th>
				<th>Action</th>
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
			<tr><td colspan="5" align="left"><b>
			<?php $romawi = $romawi + 1; echo numberToRomanRepresentation($romawi) . ".";?>
			{{ $grup->aspekgrup->nama_aspekgrup }}
			</td></tr>
			<?php $i = 0; ?>
			@foreach($daftarnilai as $nilaikuesioner)
			@if($grup->aspekgrup->id == $nilaikuesioner->id_aspekgrup)
			<tr>
				<td align="right"><?php $i = $i + 1; echo $i . "."; ?></td>
				<td align="justify">{{ $nilaikuesioner->kuesioner->deskripsi}}</td>	
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
			@endif
			@endforeach
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