<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>SHU</title>
    </head>
        <body> 
        @if (count($daftarumum) > 0)
        <table class="table table-bordered">
            <tr align="center">
                <td><b>Kode Transaksi</td>
                <td><b>Id Akun</td>
                <td><b>Tanggal</th>
                <td><b>Keterangan</td>	
                <td><b>Debet</td>
                <td><b>Kredit</td>
                <td><b>Saldo</td>
            </tr>
            <tbody>
            <?php $saldo=0; ?>
            <?php foreach($daftarumum as $umum): ?>
            <tr align="center">
                <td>{{ $umum->kodetransaksi }}</td>
                <td>{{ $umum->akun->nama_akun }}</td>
                <td>{{ $umum->tanggal }}</td>
                <td>{{ $umum->keterangan }}</td>
                @if($umum->status == 'debit')
                <?php $saldo = $saldo + $umum->nominal ?>
                <td align="right">{{ $umum->nominal }}</td><td></td>
                @elseif($umum->status == 'kredit')
                <?php $saldo = $saldo - $umum->nominal ?>
                <td></td><td align="right">{{ $umum->nominal }}</td>
                @endif
                <td align="right">{{ $saldo }}</td>
            </tr>
            <?php endforeach ?>
            <tr><td colspan="5"></td><td align="right"><b>Saldo Akhir</td><td align="right">{{ $saldo }}</td></tr>
            </tbody>
        </table>
        @else
        <p>Tidak ada data transaksi.</p>
        @endif