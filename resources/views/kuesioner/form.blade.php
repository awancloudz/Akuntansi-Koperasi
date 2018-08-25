@if (isset($kuesioner))
{!! Form::hidden('id', $kuesioner->id) !!}
@endif

{{-- Kode Header --}}
<div class="form-group">
{!! Form::label('id_aspekgrup','Aspek Grup Kuesioner',['class' => 'control-label']) !!}
@if(count($list_aspek) > 0)
{!! Form::select('id_aspekgrup', $list_aspek, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_aspekgrup','placeholder'=>'Pilih Aspek']) !!}
@else
<p>Tidak ada pilihan grup kategori,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_aspekgrup'))
<span class="help-block">{{ $errors->first('id_aspekgrup') }}</span>
@endif
</div>

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('deskripsi','Deskripsi Kuesioner',['class' => 'control-label']) !!}
{!! Form::text('deskripsi', null,['class' => 'form-control']) !!}
@if ($errors->has('deskripsi'))
<span class="help-block">{{ $errors->first('deskripsi') }}</span>
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

