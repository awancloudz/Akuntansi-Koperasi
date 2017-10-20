@if (isset($header))
{!! Form::hidden('id', $header->id) !!}
@endif

{{-- Kode --}}
@if($errors->any())
<div class="form-group {{ $errors->has('kode_header') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('kode_header','Kode Header',['class' => 'control-label']) !!}
{!! Form::text('kode_header', null,['class' => 'form-control']) !!}
@if ($errors->has('kode_header'))
<span class="help-block">{{ $errors->first('kode_header') }}</span>
@endif
</div>

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nama_header') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nama_header','Nama Header',['class' => 'control-label']) !!}
{!! Form::text('nama_header', null,['class' => 'form-control']) !!}
@if ($errors->has('nama_header'))
<span class="help-block">{{ $errors->first('nama_header') }}</span>
@endif
</div>

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>
