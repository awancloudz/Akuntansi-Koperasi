<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>SHU</title>
    </head>
        <body> 
        @if (count($daftarsimpanan) > 0)
        <table class="table table-bordered">
            <tr align="center">
                <td><b>Kode Transaksi</td>
                <td><b>Id Akun</td>
                <td><b>Nama Nasabah</td>
                <td><b>Tanggal</th>
                <td><b>Jenis Simpanan</td>	
                <td><b>Debet</td>
                <td><b>Kredit</td>
                <td><b>Saldo</td>
            </tr>
            <tbody>
            <?php $saldo=0; ?>
            <?php foreach($daftarsimpanan as $simpanan): ?>
            <tr align="center">
                <td>{{ $simpanan->kodetransaksi }}</td>
                <td>{{ $simpanan->akun->nama_akun }}</td>
                <td>{{ $simpanan->nasabah->nama }}</td>
                <td>{{ $simpanan->tanggal }}</td>
                <td>{{ $simpanan->jenis_simpanan }}</td>
                @if($simpanan->status == 'debit')
                <?php $saldo = $saldo + $simpanan->nominal_simpan ?>
                <td align="right">{{ $simpanan->nominal_simpan }}</td><td></td>
                @elseif($simpanan->status == 'kredit')
                <?php $saldo = $saldo - $simpanan->nominal_simpan ?>
                <td></td><td align="right">{{ $simpanan->nominal_simpan }}</td>
                @endif
                <td align="right">{{ $saldo }}</td>
            </tr>
            <?php endforeach ?>
            <tr><td colspan="6"></td><td align="right"><b>Saldo Akhir</td><td align="right">{{ $saldo }}</td></tr>
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