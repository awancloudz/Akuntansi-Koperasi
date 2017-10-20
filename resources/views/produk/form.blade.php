@if (isset($produk))
{!! Form::hidden('id', $produk->id) !!}
@endif
<div class="row">
  <div class="col-md-6">
	{{-- Kode --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('kodeproduk') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('kodeproduk','Kode Produk',['class' => 'control-label']) !!}
		{!! Form::text('kodeproduk', null,['class' => 'form-control']) !!}
		@if ($errors->has('kodeproduk'))
		<span class="help-block">{{ $errors->first('kodeproduk') }}</span>
		@endif
	</div>
  </div>
  <div class="col-md-6">
	{{-- Harga jual --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('hargajual') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('hargajual','Harga Jual',['class' => 'control-label']) !!}
		{!! Form::text('hargajual', null,['class' => 'form-control']) !!}
		@if ($errors->has('hargajual'))
		<span class="help-block">{{ $errors->first('hargajual') }}</span>
		@endif
	</div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
	{{-- Nama --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('namaproduk') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('namaproduk','Nama Produk',['class' => 'control-label']) !!}
		{!! Form::text('namaproduk', null,['class' => 'form-control']) !!}
		@if ($errors->has('namaproduk'))
		<span class="help-block">{{ $errors->first('namaproduk') }}</span>
		@endif
	</div>
  </div>
  <div class="col-md-6">
	{{-- Harga Grosir --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('hargagrosir') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('hargagrosir','Harga Grosir',['class' => 'control-label']) !!}
		{!! Form::text('hargagrosir', null,['class' => 'form-control']) !!}
		@if ($errors->has('hargagrosir'))
		<span class="help-block">{{ $errors->first('hargagrosir') }}</span>
		@endif
	</div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
	{{-- Seri --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('seriproduk') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('seriproduk','Seri Produk',['class' => 'control-label']) !!}
		{!! Form::text('seriproduk', null,['class' => 'form-control']) !!}
		@if ($errors->has('seriproduk'))
		<span class="help-block">{{ $errors->first('seriproduk') }}</span>
		@endif
	</div>
  </div>
  <div class="col-md-6">
	{{-- Harga Distributor --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('hargadistributor') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('hargadistributor','Harga Distributor',['class' => 'control-label']) !!}
		{!! Form::text('hargadistributor', null,['class' => 'form-control']) !!}
		@if ($errors->has('hargadistributor'))
		<span class="help-block">{{ $errors->first('hargadistributor') }}</span>
		@endif
	</div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
	{{--  Kategori --}}
	<div class="form-group">
		{!! Form::label('id_kategoriproduk','Kategori Produk',['class' => 'control-label']) !!}
		@if(count($list_kategoriproduk) > 0)
		{!! Form::select('id_kategoriproduk', $list_kategoriproduk, null,['class' => 'form-control', 'id'=>'id_kategoriproduk','placeholder'=>'Pilih Kategori Produk']) !!}
		@else
		<p>Tidak ada pilihan kategori produk,silahkan buat dulu.</p>
		@endif
		@if ($errors->has('id_kategoriproduk'))
		<span class="help-block">{{ $errors->first('id_kategoriproduk') }}</span>
		@endif
	</div>
  </div>
  <div class="col-md-6">
	{{-- Diskon --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('diskon') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('diskon','Diskon ( % )',['class' => 'control-label']) !!}
		{!! Form::text('diskon', null,['class' => 'form-control']) !!}
		@if ($errors->has('diskon'))
		<span class="help-block">{{ $errors->first('diskon') }}</span>
		@endif
	</div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
	{{-- Bahan --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('jenisproduk') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('jenisproduk','Jenis Bahan',['class' => 'control-label']) !!}
		<div class="radio">
		<label>
		{!! Form::radio('jenisproduk','plastik') !!} Plastik
		</label>
		</div>
		<div class="radio">
		<label>{!! Form::radio('jenisproduk','kaca') !!} Kaca
		</label>
		</div>
		@if ($errors->has('jenisproduk'))
		<span class="help-block">{{ $errors->first('jenisproduk') }}</span>
		@endif
	</div>
  </div>
  <div class="col-md-6">
	{{-- Stok --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('stok') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('stok','Stok Produk',['class' => 'control-label']) !!}
		{!! Form::text('stok', null,['class' => 'form-control']) !!}
		@if ($errors->has('stok'))
		<span class="help-block">{{ $errors->first('stok') }}</span>
		@endif
	</div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
	{{--  Distributor --}}
	<div class="form-group">
		{!! Form::label('id_distributor','Distributor',['class' => 'control-label']) !!}
		@if(count($list_distributor) > 0)
		{!! Form::select('id_distributor', $list_distributor, null,['class' => 'form-control', 'id'=>'id_distributor','placeholder'=>'Pilih Distributor']) !!}
		@else
		<p>Tidak ada pilihan distributor,silahkan buat dulu.</p>
		@endif
		@if ($errors->has('id_distributor'))
		<span class="help-block">{{ $errors->first('id_distributor') }}</span>
		@endif
	</div>
  </div>
  <div class="col-md-6">
	{{-- Foto --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('foto') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
		{!! Form::label('foto','Foto') !!}
		{!! Form::file('foto') !!}
		@if ($errors->has('foto'))
		<span class="help-block">{{ $errors->first('foto') }}</span>
		@endif
	</div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
	{{-- Submit button --}}
	<div class="form-group">
		{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
	</div>
  </div>
</div>