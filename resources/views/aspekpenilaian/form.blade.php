@if (isset($aspekpenilaian))
{!! Form::hidden('id', $aspekpenilaian->id) !!}
@endif

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nama_aspekpenilaian') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nama_aspekpenilaian','Nama Aspek Penilaian',['class' => 'control-label']) !!}
{!! Form::text('nama_aspekpenilaian', null,['class' => 'form-control']) !!}
@if ($errors->has('nama_aspekpenilaian'))
<span class="help-block">{{ $errors->first('nama_aspekpenilaian') }}</span>
@endif
</div>

{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>
