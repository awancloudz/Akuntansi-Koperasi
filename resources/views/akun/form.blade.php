@if (isset($akun))
{!! Form::hidden('id', $akun->id) !!}
@endif

{{-- Kode Header --}}
<div class="form-group">
{!! Form::label('id_header','Header',['class' => 'control-label']) !!}
@if(count($list_header) > 0)
{!! Form::select('id_header', $list_header, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_header','placeholder'=>'Pilih Header']) !!}
@else
<p>Tidak ada pilihan keanggotaan,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_header'))
<span class="help-block">{{ $errors->first('id_header') }}</span>
@endif
</div>

{{-- Kode --}}
@if($errors->any())
<div class="form-group {{ $errors->has('kode_akun') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('kode_akun','Kode Akun',['class' => 'control-label']) !!}
{!! Form::text('kode_akun', null,['class' => 'form-control']) !!}
@if ($errors->has('kode_akun'))
<span class="help-block">{{ $errors->first('kode_akun') }}</span>
@endif
</div>

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nama_akun') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nama_akun','Nama Akun',['class' => 'control-label']) !!}
{!! Form::text('nama_akun', null,['class' => 'form-control']) !!}
@if ($errors->has('nama_akun'))
<span class="help-block">{{ $errors->first('nama_akun') }}</span>
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

