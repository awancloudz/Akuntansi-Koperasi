@if (isset($komponenpenilaian))
{!! Form::hidden('id', $komponenpenilaian->id) !!}
@endif

{{-- Kode Aspek --}}
<div class="form-group">
{!! Form::label('id_aspekpenilaian','Aspek Penilaian Kesehatan',['class' => 'control-label']) !!}
@if(count($list_aspek) > 0)
{!! Form::select('id_aspekpenilaian', $list_aspek, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_aspekpenilaian','placeholder'=>'Pilih Aspek']) !!}
@else
<p>Tidak ada pilihan aspek penilaian,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_aspekpenilaian'))
<span class="help-block">{{ $errors->first('id_aspekpenilaian') }}</span>
@endif
</div>

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('komponen') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('komponen','Nama Komponen',['class' => 'control-label']) !!}
{!! Form::text('komponen', null,['class' => 'form-control']) !!}
@if ($errors->has('komponen'))
<span class="help-block">{{ $errors->first('komponen') }}</span>
@endif
</div>

{{-- Bobot --}}
@if($errors->any())
<div class="form-group {{ $errors->has('bobot') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('bobot','Bobot (dalam %)',['class' => 'control-label']) !!}
{!! Form::text('bobot', null,['class' => 'form-control']) !!}
@if ($errors->has('bobot'))
<span class="help-block">{{ $errors->first('bobot') }}</span>
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

