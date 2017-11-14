<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Jurnal Umum</title>
    </head>
        <body> 
		@if (count($daftarjurnal) > 0)
		<table class="table table-bordered">
			<thead>
				<tr align="center">
					<td><b>Tanggal</td>
					<td><b>Keterangan</td>	
					<td><b>Debet</td>
					<td><b>Kredit</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($daftarjurnal as $jurnal): ?>
				<tr align="center"> 
					<td>{{ $jurnal->tanggal }}</td>
					@if($jurnal->status == 'debit')
					<td align="left">{{ $jurnal->keterangan }}</td>
					<td align="right">{{ $jurnal->nominal }}</td><td></td>
					@elseif($jurnal->status == 'kredit')
					<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{ $jurnal->keterangan }}</td>
					<td></td><td align="right">{{ $jurnal->nominal }}</td>
					@endif
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
		@else
		<p>Tidak ada data transaksi.</p>
		@endif
		<script type="text/javascript">
          print();
        </script>
        </body>
</html>