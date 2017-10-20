@if (Auth::check())
	@if (isset($nasabah))
	{!! Form::hidden('id', $nasabah->id) !!}
	{!! Form::hidden('id_users', $nasabah->id_users ) !!}
	@else
	{!! Form::hidden('id_users', Auth::user()->id ) !!}
	@endif
@endif

{{-- No.Nasabah --}}
@if($errors->any())
<div class="form-group {{ $errors->has('no_nasabah') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('no_nasabah','No.Nasabah',['class' => 'control-label']) !!}
{!! Form::text('no_nasabah', null,['class' => 'form-control']) !!}
@if ($errors->has('no_nasabah'))
<span class="help-block">{{ $errors->first('no_nasabah') }}</span>
@endif
</div>

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nama') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nama','Nama Nasabah',['class' => 'control-label']) !!}
{!! Form::text('nama', null,['class' => 'form-control']) !!}
@if ($errors->has('nama'))
<span class="help-block">{{ $errors->first('nama') }}</span>
@endif
</div>

{{-- Alamat --}}
@if($errors->any())
<div class="form-group {{ $errors->has('alamat') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('alamat','Alamat',['class' => 'control-label']) !!}
{!! Form::text('alamat', null,['class' => 'form-control']) !!}
@if ($errors->has('alamat'))
<span class="help-block">{{ $errors->first('alamat') }}</span>
@endif
</div>

{{-- No.HP --}}
@if($errors->any())
<div class="form-group {{ $errors->has('no_hp') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('no_hp','No.Handphone',['class' => 'control-label']) !!}
{!! Form::text('no_hp', null,['class' => 'form-control']) !!}
@if ($errors->has('no_hp'))
<span class="help-block">{{ $errors->first('no_hp') }}</span>
@endif
</div>

{{-- Keanggotaan --}}
<div class="form-group">
{!! Form::label('id_keanggotaan','Keanggotaan',['class' => 'control-label']) !!}
@if(count($list_keanggotaan) > 0)
{!! Form::select('id_keanggotaan', $list_keanggotaan, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_keanggotaan','placeholder'=>'Pilih Keanggotaan']) !!}
@else
<p>Tidak ada pilihan keanggotaan,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_keanggotaan'))
<span class="help-block">{{ $errors->first('id_keanggotaan') }}</span>
@endif
</div>

{{-- Tanggal --}}
@if($errors->any())
<div class="form-group {{ $errors->has('tanggal_masuk') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('tanggal_masuk','Tanggal Masuk',['class' => 'control-label']) !!}
{!! Form::date('tanggal_masuk', null,['class' => 'form-control']) !!}
@if ($errors->has('tanggal_masuk'))
<span class="help-block">{{ $errors->first('tanggal_masuk') }}</span>
@endif
</div>

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
