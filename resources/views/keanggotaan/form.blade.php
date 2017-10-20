@if (Auth::check())
	@if (isset($keanggotaan))
	{!! Form::hidden('id', $keanggotaan->id) !!}
	{!! Form::hidden('id_users', $keanggotaan->id_users ) !!}
	@else
	{!! Form::hidden('id_users', Auth::user()->id ) !!}
	@endif
@endif

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nama_keanggotaan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nama_keanggotaan','Nama Keanggotaan',['class' => 'control-label']) !!}
{!! Form::text('nama_keanggotaan', null,['class' => 'form-control']) !!}
@if ($errors->has('nama_keanggotaan'))
<span class="help-block">{{ $errors->first('nama_keanggotaan') }}</span>
@endif
</div>

{{-- Simpanan Pokok --}}
@if($errors->any())
<div class="form-group {{ $errors->has('simpanan_pokok') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('simpanan_pokok','Simpanan Pokok',['class' => 'control-label']) !!}
{!! Form::text('simpanan_pokok', null,['class' => 'form-control']) !!}
@if ($errors->has('simpanan_pokok'))
<span class="help-block">{{ $errors->first('simpanan_pokok') }}</span>
@endif
</div>

{{-- Simpanan Wajib --}}
@if($errors->any())
<div class="form-group {{ $errors->has('simpanan_wajib') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('simpanan_wajib','Simpanan Wajib',['class' => 'control-label']) !!}
{!! Form::text('simpanan_wajib', null,['class' => 'form-control']) !!}
@if ($errors->has('simpanan_wajib'))
<span class="help-block">{{ $errors->first('simpanan_wajib') }}</span>
@endif
</div>

{{-- Bunga Simpanan --}}
@if($errors->any())
<div class="form-group {{ $errors->has('bunga_simpanan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('bunga_simpanan','Bunga Simpanan',['class' => 'control-label']) !!}
{!! Form::text('bunga_simpanan', null,['class' => 'form-control']) !!}
@if ($errors->has('bunga_simpanan'))
<span class="help-block">{{ $errors->first('bunga_simpanan') }}</span>
@endif
</div>

{{-- Bunga Pinjaman --}}
@if($errors->any())
<div class="form-group {{ $errors->has('bunga_pinjaman') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('bunga_pinjaman','Bunga Pinjaman',['class' => 'control-label']) !!}
{!! Form::text('bunga_pinjaman', null,['class' => 'form-control']) !!}
@if ($errors->has('bunga_pinjaman'))
<span class="help-block">{{ $errors->first('bunga_pinjaman') }}</span>
@endif
</div>

{{-- Denda Pinjaman --}}
@if($errors->any())
<div class="form-group {{ $errors->has('denda_pinjaman') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('denda_pinjaman','Denda Pinjaman',['class' => 'control-label']) !!}
{!! Form::text('denda_pinjaman', null,['class' => 'form-control']) !!}
@if ($errors->has('denda_pinjaman'))
<span class="help-block">{{ $errors->first('denda_pinjaman') }}</span>
@endif
</div>

{{-- Keterangan --}}
<div class="form-group">
{!! Form::label('keterangan','Keterangan',['class' => 'control-label']) !!}
{!! Form::text('keterangan', null,['class' => 'form-control']) !!}
</div>

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>
