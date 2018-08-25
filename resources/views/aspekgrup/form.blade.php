@if (isset($aspekgrup))
{!! Form::hidden('id', $aspekgrup->id) !!}
@endif

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nama_aspekgrup') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nama_aspekgrup','Nama Aspek Kuesioner',['class' => 'control-label']) !!}
{!! Form::text('nama_aspekgrup', null,['class' => 'form-control']) !!}
@if ($errors->has('nama_aspekgrup'))
<span class="help-block">{{ $errors->first('nama_aspekgrup') }}</span>
@endif
</div>

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>
