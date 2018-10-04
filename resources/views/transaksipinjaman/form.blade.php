@if (Auth::check())
	@if (isset($transaksipinjaman))
	{!! Form::hidden('id', $transaksipinjaman->id) !!}
	{!! Form::hidden('id_users', $transaksipinjaman->id_users ) !!}
	@else
	{!! Form::hidden('id_users', Auth::user()->id ) !!}
	@endif
@endif

<div class="row">
<div class="col-md-6">
	{{-- Kode Transaksi --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('kodetransaksi') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('kodetransaksi','Kode Transaksi',['class' => 'control-label']) !!}
	{!! Form::text('kodetransaksi', null,['class' => 'form-control','id'=>'kodetransaksi','readonly']) !!}
	@if ($errors->has('kodetransaksi'))
	<span class="help-block">{{ $errors->first('kodetransaksi') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
	{{-- Akun --}}
	<div class="form-group">
	{!! Form::label('id_akun','Akun',['class' => 'control-label']) !!}
	@if(count($list_akun) > 0)
	{!! Form::select('id_akun', $list_akun, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_akun','placeholder'=>'Pilih Akun']) !!}
	@else
	<p>Tidak ada pilihan akun,silahkan buat dulu.</p>
	@endif
	@if ($errors->has('id_akun'))
	<span class="help-block">{{ $errors->first('id_akun') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
	{{-- Nasabah --}}
	<div class="form-group">
	{!! Form::label('id_nasabah','Nasabah',['class' => 'control-label']) !!}
	@if(count($list_nasabah) > 0)
	{!! Form::select('id_nasabah', $list_nasabah, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_nasabah','placeholder'=>'Pilih Nasabah']) !!}
	@else
	<p>Tidak ada pilihan nasabah,silahkan buat dulu.</p>
	@endif
	@if ($errors->has('id_nasabah'))
	<span class="help-block">{{ $errors->first('id_nasabah') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-2">
	{{-- Tanggal --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('tanggal') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('tanggal','Tanggal Transaksi',['class' => 'control-label']) !!}
	{!! Form::date('tanggal', null,['class' => 'form-control']) !!}
	@if ($errors->has('tanggal'))
	<span class="help-block">{{ $errors->first('tanggal') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
	{{-- Nominal --}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('nominal_pinjam') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('nominal_pinjam','Nominal Pinjam',['class' => 'control-label']) !!}
	{!! Form::text('nominal_pinjam', null,['class' => 'form-control']) !!}
	@if ($errors->has('nominal_pinjam'))
	<span class="help-block">{{ $errors->first('nominal_pinjam') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
	{{-- Kali Angsuran--}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('kali_angsuran') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('kali_angsuran','Kali Angsuran',['class' => 'control-label']) !!}
	{!! Form::text('kali_angsuran', null,['class' => 'form-control']) !!}
	@if ($errors->has('kali_angsuran'))
	<span class="help-block">{{ $errors->first('kali_angsuran') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
	{{-- Nominal Angsuran--}}
	@if($errors->any())
	<div class="form-group {{ $errors->has('nominal_angsuran') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('nominal_angsuran','Nominal Angsuran',['class' => 'control-label']) !!}
	{!! Form::text('nominal_angsuran', null,['class' => 'form-control']) !!}
	@if ($errors->has('nominal_angsuran'))
	<span class="help-block">{{ $errors->first('nominal_angsuran') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-2">
	{{-- Submit button --}}
	<div class="form-group">
	{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
	</div>
</div>
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
