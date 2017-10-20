<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Produk</title>
        <style type="text/css">
        @page { margin: 0px; margin-top:27px;}
        #putar {
          -webkit-transform: rotate(90deg);
          -moz-transform: rotate(90deg);
          -o-transform: rotate(90deg);
          -ms-transform: rotate(90deg);
          transform: rotate(90deg);
        }
        #putar2 {
          -webkit-transform: rotate(-90deg);
          -moz-transform: rotate(-90deg);
          -o-transform: rotate(-90deg);
          -ms-transform: rotate(-90deg);
          transform: rotate(-90deg);
        }
        body{
            font-family: helvetica;
        }
        </style>
    </head>
        <body> 
        <?php 
        function rupiah($nilai, $pecahan = 0) {
        return "Rp. " . number_format($nilai, $pecahan, ',', '.');
        } 
        ?>
        <table align="center">
        <tr><td>
          <div id="putar">
              @foreach ($profiletoko as $toko)
              <center>{{ $toko->nama }}</center>
              @endforeach
              <table align="center">
              <tr><td>
              <?php
              echo DNS1D::getBarcodeHTML($produk->kodeproduk, "C128",1,50);
              ?>
              </td></tr>
              </table>
              <center>{{ $produk->kodeproduk }}</center>
          </div>
        </td><td>
          <div id="putar2">
            <center>{{ $produk->namaproduk }}</center>
            <center>{{ $produk->seriproduk }}</center>
            <center>{{ rupiah($produk->hargajual) }}</center>
            @if ($produk->diskon > 0) 
            <center>DISKON {{ $produk->diskon }} %</center>
            @endif
          </div>
        </td></tr>
        </table>
        
        <script type="text/javascript">
          print();
        </script>
        </body>
</html>