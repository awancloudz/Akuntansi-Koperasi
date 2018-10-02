@if (isset($nilaikuesioner))
{!! Form::hidden('id', $nilaikuesioner->id) !!}
@endif

{{-- Deskripsi Kuesioner --}}
<div class="form-group">
{!! Form::label('id_kuesioner','Deskripsi Kuesioner',['class' => 'control-label']) !!}<br>
<?php echo strtoupper($nilaikuesioner->kuesioner->deskripsi); ?>
</div>

{{-- Pilihan Kuesioner --}}
@if($errors->any())
<div class="form-group {{ $errors->has('pilihan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('pilihan','Pilihan Kuesioner',['class' => 'control-label','id' => 'pilihan']) !!}
<div class="radio">
<label>
{!! Form::radio('pilihan','ya') !!} YA
</label>
</div>
<div class="radio">
<label>{!! Form::radio('pilihan','tidak') !!} TIDAK
</label>
</div>
@if ($errors->has('pilihan'))
<span class="help-block">{{ $errors->first('pilihan') }}</span>
@endif
</div>

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

