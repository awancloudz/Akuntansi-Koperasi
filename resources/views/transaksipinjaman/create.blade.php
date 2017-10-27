@extends('template')

@section('main')
	<div id="transaksipinjaman" class="panel panel-default">
		<div class="panel-heading"><b><h4>Tambah Transaksi Pinjaman</h4></b></div>
		<div class="panel-body">
		{!! Form::open(['url' => 'transaksipinjaman', 'files' => true]) !!}
		@include('transaksipinjaman.form', ['submitButtonText' => 'Simpan Transaksi'])
		{!! Form::close() !!}
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		<?php
			//Deteksi kode transaksi
			if($daftar->count() > 0){
			$kd = "TR-PINJ".sprintf("%05s", $kodeakhir->id + 1);
			}
			else
			{
			$kd = "TR-PINJ00001";
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