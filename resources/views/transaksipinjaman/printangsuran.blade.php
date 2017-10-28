<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Daftar Angsuran</title>
    </head>
    <body>  
    @if (count($daftarangsuran) > 0)
	<table class="table">
		<thead>
			<tr>
				<th>Angsuran</th>
				<th>Jasa Uang</th>
				<th>Total Bayar</th>
				<th>Saldo</th>	
				<th>Jatuh Tempo</th>
				<th>Tanggal Bayar</th>
                <th>Status Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			<?php foreach($daftarangsuran as $angsuran): ?>
			<tr>
				<td>{{ $angsuran->angsuran }}</td>
				<td>{{ $angsuran->jasa_uang }}</td>
				<td>{{ $angsuran->total_bayar }}</td>
				<td>{{ $angsuran->saldo }}</td>
				<td>{{ $angsuran->jatuh_tempo }}</td>	
				<td>{{ $angsuran->tanggal_bayar }}</td>
                <td>{{ $angsuran->status_bayar }}</td>	
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	@else
	<p>Tidak ada data angsuran.</p>
	@endif 
        
    <script type="text/javascript">
    print();
    </script>
    </body>
</html>