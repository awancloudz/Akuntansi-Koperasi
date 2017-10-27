@extends('template')

@section('main')
	<div id="transaksipenarikan" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Transaksi Penarikan - {{ $nasabah->nama }}</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'transaksipenarikan', 'files' => true]) !!}
		@include('transaksipenarikan.form', ['submitButtonText' => 'Simpan Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		<?php
			//Deteksi kode transaksi
			if($daftar->count() > 0){
			$kd = "TR-PENR".sprintf("%05s", $kodeakhir->id + 1);
			}
			else
			{
			$kd = "TR-SIMP00001";
			}
			echo "var kd = '{$kd}';";
		?>
		//Memberikan value kode transaksi
		document.getElementById("kodetransaksi").value = kd;
	});
</script>
@stop

@section('footer')
	@include('footer')
@stop