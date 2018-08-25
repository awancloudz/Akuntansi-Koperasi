<nav class="navbar navbar-default">
<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" 
				data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<a class="navbar-brand" href="{{ url('/')}}"><b>SIMKORA</b></a>
	</div>
	<div class="collapse navbar-collapse"
		 id="bs-example-navbar-collapse-1">
		 <ul class="nav navbar-nav">
			<li class="dropdown">
		 		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Data Master<span class="caret"></span></a>
		 		<ul class="dropdown-menu" role="menu">
                    @if (!empty($halaman) && $halaman == 'header')
					<li class="active"><a href="{{ url('header') }}">Grup Kategori</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('header') }}">Grup Kategori</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'akun')
					<li class="active"><a href="{{ url('akun') }}">Data Akun</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('akun') }}">Data Akun</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'keanggotaan')
					<li class="active"><a href="{{ url('keanggotaan') }}">Keanggotaan</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('keanggotaan') }}">Keanggotaan</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'aspekgrup')
					<li class="active"><a href="{{ url('aspekgrup') }}">Aspek Kuesioner</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('aspekgrup') }}">Aspek Kuesioner</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'kuesioner')
					<li class="active"><a href="{{ url('kuesioner') }}">Data Kuesioner</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('kuesioner') }}">Data Kuesioner</a></li>
					@endif
                </ul>
		 	</li>
		 			@if (!empty($halaman) && $halaman == 'nasabah')
					<li class="active"><a href="{{ url('nasabah') }}">Data Nasabah</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('nasabah') }}">Data Nasabah</a></li>
					@endif
			<li class="dropdown">
		 		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Transaksi<span class="caret"></span></a>
		 		<ul class="dropdown-menu" role="menu">
                    @if (!empty($halaman) && $halaman == 'transaksisimpanan')
					<li class="active"><a href="{{ url('transaksisimpanan') }}">Simpanan</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('transaksisimpanan') }}">Simpanan</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'transaksipinjaman')
					<li class="active"><a href="{{ url('transaksipinjaman') }}">Pinjaman</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('transaksipinjaman') }}">Pinjaman</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'transaksiumum')
					<li class="active"><a href="{{ url('transaksiumum') }}">Umum</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('transaksiumum') }}">Umum</a></li>
					@endif
                </ul>
		 	</li>
		 	<li class="dropdown">
		 		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Laporan<span class="caret"></span></a>
		 		<ul class="dropdown-menu" role="menu">
				 	@if (!empty($halaman) && $halaman == 'nilaikuesioner')
					<li class="active"><a href="{{ url('nilaikuesioner') }}">Penilaian Aspek Manajemen</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('nilaikuesioner') }}">Penilaian Aspek Manajemen</a></li>
					@endif
                    @if (!empty($halaman) && $halaman == 'jurnalumum')
					<li class="active"><a href="{{ url('jurnalumum') }}">Jurnal Umum</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('jurnalumum') }}">Jurnal Umum</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'lapsimpanan')
					<li class="active"><a href="{{ url('lapsimpanan') }}"> Simpanan</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('lapsimpanan') }}"> Simpanan</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'lappinjaman')
					<li class="active"><a href="{{ url('lappinjaman') }}"> Pinjaman</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('lappinjaman') }}"> Pinjaman</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'lapumum')
					<li class="active"><a href="{{ url('lapumum') }}"> Transaksi Umum</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('lapumum') }}"> Transaksi Umum</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'shu')
					<li class="active"><a href="{{ url('shu') }}">SHU</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('shu') }}">SHU</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'aruskas')
					<li class="active"><a href="{{ url('aruskas') }}">Arus Kas</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('aruskas') }}">Arus Kas</a></li>
					@endif
					@if (!empty($halaman) && $halaman == 'neraca')
					<li class="active"><a href="{{ url('neraca') }}">Neraca</a>
					<span class="sr-only">(current)</span></li>
					@else
					<li><a href="{{ url('neraca') }}">Neraca</a></li>
					@endif
                </ul>
		 	</li>
		 </ul>
		 <ul class="nav navbar-nav navbar-right">
		 	@if (Auth::check())
		 	<li class="dropdown">
		 		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> {{ Auth::user()->name }} <span class="caret"></span></a>
		 		<ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                </ul>
		 	</li>
		 	@endif
		 </ul>
	</div>
</div>
</nav>

