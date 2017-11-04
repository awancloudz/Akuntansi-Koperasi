@if (isset($header))
{!! Form::hidden('id', $header->id) !!}
@endif

{{-- Grup--}}
<div class="form-group">
{!! Form::label('id_grup','Grup Kategori',['class' => 'control-label']) !!}
@if(count($list_grup) > 0)
{!! Form::select('id_grup', $list_grup, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_grup','placeholder'=>'Pilih Grup']) !!}
@else 
<p>Tidak ada pilihan grup kategori,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_grup'))
<span class="help-block">{{ $errors->first('id_grup') }}</span>
@endif
</div>

{{-- Kode --}}
@if($errors->any())
<div class="form-group {{ $errors->has('kode_header') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('kode_header','Kode Kategori',['class' => 'control-label']) !!}
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
{!! Form::label('nama_header','Nama Kategori',['class' => 'control-label']) !!}
{!! Form::text('nama_header', null,['class' => 'form-control']) !!}
@if ($errors->has('nama_header'))
<span class="help-block">{{ $errors->first('nama_header') }}</span>
@endif
</div>

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>
