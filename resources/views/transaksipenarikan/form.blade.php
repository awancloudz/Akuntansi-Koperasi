@if (Auth::check())
	@if (isset($transaksipenarikan))
	{!! Form::hidden('id', $transaksipenarikan->id) !!}
	{!! Form::hidden('id_users', $transaksipenarikan->id_users ) !!}
	@else
	@include('_partial.flash_message')
	{!! Form::hidden('id_users', Auth::user()->id ) !!}
	@endif
@endif
{!! Form::hidden('simpanan_pokok', 0) !!}
{{-- Kode Transaksi --}}
@if($errors->any())
<div class="form-group {{ $errors->has('kodetransaksi') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('kodetransaksi','Kode Transaksi',['class' => 'control-label']) !!}
{!! Form::text('kodetransaksi', null,['class' => 'form-control']) !!}
@if ($errors->has('kodetransaksi'))
<span class="help-block">{{ $errors->first('kodetransaksi') }}</span>
@endif
</div>

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

@if (isset($transaksipenarikan))
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
@else
	{!! Form::hidden('id_nasabah', $nasabah->id ) !!}
@endif

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
{!! Form::text('saldo', $saldo) !!}
{!! Form::hidden('jenis_simpanan', 'penarikan') !!}

{{-- Nominal --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nominal_simpan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nominal_simpan','Nominal Penarikan',['class' => 'control-label']) !!}
{!! Form::text('nominal_simpan', null,['class' => 'form-control']) !!}
@if ($errors->has('nominal_simpan'))
<span class="help-block">{{ $errors->first('nominal_simpan') }}</span>
@endif
</div>
{!! Form::hidden('status', 'kredit') !!}

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
