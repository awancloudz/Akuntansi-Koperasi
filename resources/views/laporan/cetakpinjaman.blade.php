<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>SHU</title>
    </head>
        <body> 
        @if (count($daftarpinjaman) > 0)
        <table class="table table-bordered">
            <tr align="center">
                <td><b>Kode Transaksi</td>
                <td><b>Id Akun</td>
                <td><b>Nama Nasabah</td>
                <td><b>Tanggal</td>
                <td><b>Nominal Pinjam</td>	
                <td><b>Kali Angsuran</td>
                <td><b>Nominal Angsuran</td>
            </tr>
            <tbody>
            <?php foreach($daftarpinjaman as $pinjaman): ?>
            <tr align="center">
                <td>{{ $pinjaman->kodetransaksi }}</td>
                <td>{{ $pinjaman->akun->nama_akun }}</td>
                <td>{{ $pinjaman->nasabah->nama }}</td>
                <td>{{ $pinjaman->tanggal }}</td>
                <td align="right">{{ $pinjaman->nominal_pinjam }}</td>
                <td>{{ $pinjaman->kali_angsuran }}</td>	
                <td align="right">{{ $pinjaman->nominal_angsuran }}</td>	
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