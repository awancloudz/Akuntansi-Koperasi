@if (isset($user))
{!! Form::hidden('id', $user->id) !!}
@endif

{{-- Nama --}}
@if($errors->any())
<div class="form-group {{ $errors->has('name') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
	{!! Form::label('name','Nama',['class' => 'control-label']) !!}
	{!! Form::text('name', null,['class' => 'form-control']) !!}
	@if ($errors->has('name'))
	<span class="help-block">{{ $errors->first('name') }}</span>
	@endif
</div>

{{-- Username --}}
@if($errors->any())
<div class="form-group {{ $errors->has('username') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
	{!! Form::label('username','Username',['class' => 'control-label']) !!}
	{!! Form::text('username', null,['class' => 'form-control']) !!}
	@if ($errors->has('username'))
	<span class="help-block">{{ $errors->first('username') }}</span>
	@endif
</div>

{{-- Level --}}
@if($errors->any())
<div class="form-group {{ $errors->has('level') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('level','Level',['class' => 'control-label']) !!}
	<div class="radio">
	<label>
	{!! Form::radio('level','admin') !!} Administrator
	</label>
	</div>
	<div class="radio">
	<label>{!! Form::radio('level','kasir') !!} Kasir
	</label>
	</div>
	<div class="radio">
	<label>{!! Form::radio('level','grosir') !!} Grosir
	</label>
	</div>
	@if ($errors->has('level'))
	<span class="help-block">{{ $errors->first('level') }}</span>
	@endif
</div>

{{-- Password --}}
@if($errors->any())
<div class="form-group {{ $errors->has('password') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
	{!! Form::label('password','Password',['class' => 'control-label']) !!}
	{!! Form::password('password', ['class' => 'form-control']) !!}
	@if ($errors->has('password'))
	<span class="help-block">{{ $errors->first('password') }}</span>
	@endif
</div>

{{-- Password Confirm --}}
@if($errors->any())
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
	{!! Form::label('password_confirmation','Konfirmasi Password',['class' => 'control-label']) !!}
	{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
	@if ($errors->has('password_confirmation'))
	<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
	@endif
</div>

{{-- Submit button --}}
<div class="form-group">
	{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>