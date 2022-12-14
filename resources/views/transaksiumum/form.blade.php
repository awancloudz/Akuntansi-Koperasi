@if (Auth::check())
	@if (isset($transaksiumum))
	{!! Form::hidden('id', $transaksiumum->id) !!}
	{!! Form::hidden('id_users', $transaksiumum->id_users ) !!}
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
	{!! Form::text('kodetransaksi', null,['class' => 'form-control','readonly']) !!}
	@if ($errors->has('kodetransaksi'))
	<span class="help-block">{{ $errors->first('kodetransaksi') }}</span>
	@endif
	</div>
</div>
</div>


{{-- Jenis Transaksi --}}
@if($errors->any())
<div class="form-group {{ $errors->has('jenis_simpanan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('status','Jenis Transaksi',['class' => 'control-label','id' => 'jenis_simpanan']) !!}
<div class="radio">
<label>
{!! Form::radio('status','debit') !!} Penerimaan
</label>
</div>
<div class="radio">
<label>{!! Form::radio('status','kredit') !!} Pengeluaran
</label>
</div>
@if ($errors->has('status'))
<span class="help-block">{{ $errors->first('status') }}</span>
@endif
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
	<div class="form-group {{ $errors->has('nominal') ? 'has-error' : 'has-success' }}"></div>
	@else
	<div class="form-group">
	@endif
	{!! Form::label('nominal','Nominal Transaksi',['class' => 'control-label']) !!}
	{!! Form::text('nominal', null,['class' => 'form-control']) !!}
	@if ($errors->has('nominal'))
	<span class="help-block">{{ $errors->first('nominal') }}</span>
	@endif
	</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
	{{-- Keterangan --}}
	<div class="form-group">
	{!! Form::label('keterangan','Keterangan',['class' => 'control-label']) !!}
	{!! Form::textarea('keterangan', null,['class' => 'form-control']) !!}
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
