@if (Auth::check())
	@if (isset($transaksisimpanan))
	{!! Form::hidden('id', $transaksisimpanan->id) !!}
	{!! Form::hidden('id_users', $transaksisimpanan->id_users ) !!}
	@else
	{!! Form::hidden('id_users', Auth::user()->id ) !!}
	@endif
@endif

{!! Form::hidden('simpanan_pokok', 0) !!}
{!! Form::hidden('status', 'debit') !!}
{{-- Kode Transaksi --}}
@if($errors->any())
<div class="form-group {{ $errors->has('kodetransaksi') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('kodetransaksi','Kode Transaksi',['class' => 'control-label']) !!}
{!! Form::text('kodetransaksi', null,['class' => 'form-control','readonly']) !!}
@if ($errors->has('kodetransaksi'))
<span class="help-block">{{ $errors->first('kodetransaksi') }}</span>
@endif
</div>

{{-- Akun --}}
<div class="form-group">
{!! Form::label('id_akun','Akun',['class' => 'control-label']) !!}
@if(count($list_akun) > 0)
{!! Form::select('id_akun', $list_akun, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_akun','placeholder'=>'Pilih Akun']) !!}
@else
<p>Tidak ada pilihan akun,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_akun'))
<span class="help-block">{{ $errors->first('id_akun') }}</span>
@endif
</div>

{{-- Nasabah --}}
<div class="form-group">
{!! Form::label('id_nasabah','Nasabah',['class' => 'control-label']) !!}
@if(count($list_nasabah) > 0)
{!! Form::select('id_nasabah', $list_nasabah, null,['class' => 'form-control js-example-basic-single', 'id'=>'id_nasabah','placeholder'=>'Pilih Nasabah']) !!}
@else
<p>Tidak ada pilihan nasabah,silahkan buat dulu.</p>
@endif
@if ($errors->has('id_nasabah'))
<span class="help-block">{{ $errors->first('id_nasabah') }}</span>
@endif
</div>

{{-- Tanggal --}}
@if($errors->any())
<div class="form-group {{ $errors->has('tanggal') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('tanggal','Tanggal Transaksi',['class' => 'control-label']) !!}
{!! Form::date('tanggal', null,['class' => 'form-control']) !!}
@if ($errors->has('tanggal'))
<span class="help-block">{{ $errors->first('tanggal') }}</span>
@endif
</div>

{{-- Jenis Simpananan --}}
@if($errors->any())
<div class="form-group {{ $errors->has('jenis_simpanan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('jenis_simpanan','Jenis Simpanan',['class' => 'control-label','id' => 'jenis_simpanan']) !!}
<div class="radio">
<label>
{!! Form::radio('jenis_simpanan','pokok') !!} Pokok
</label>
</div>
<div class="radio">
<label>{!! Form::radio('jenis_simpanan','sukarela') !!} Sukarela
</label>
</div>
@if ($errors->has('jenis_simpanan'))
<span class="help-block">{{ $errors->first('jenis_simpanan') }}</span>
@endif
</div>

{{-- Nominal --}}
@if($errors->any())
<div class="form-group {{ $errors->has('nominal_simpan') ? 'has-error' : 'has-success' }}"></div>
@else
<div class="form-group">
@endif
{!! Form::label('nominal_simpan','Nominal Simpan',['class' => 'control-label']) !!}
{!! Form::text('nominal_simpan', null,['class' => 'form-control']) !!}
@if ($errors->has('nominal_simpan'))
<span class="help-block">{{ $errors->first('nominal_simpan') }}</span>
@endif
</div>


{{-- Submit button --}}
<div class="form-group">
{!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    <?php
    	echo "var daftarnasabah ={$daftarnasabah}; ";
    	echo "var daftarkeanggotaan ={$daftarkeanggotaan}; ";
    ?>
    //NASABAH CHANGE
	$("#id_nasabah").change(function(){
		var id_nas = document.getElementById("id_nasabah").value;
		for(i=0; i < daftarnasabah.length; i++){
			if(daftarnasabah[i].id == id_nas){
				if(daftarnasabah[i].id_keanggotaan = daftarkeanggotaan[i].id){
					document.getElementsByName("simpanan_pokok")[0].value = daftarkeanggotaan[i].simpanan_pokok;
					var jnssimp = $('input[name="jenis_simpanan"]:checked').val();
					if(jnssimp == 'pokok'){
						document.getElementsByName("nominal_simpan")[0].value = document.getElementsByName("simpanan_pokok")[0].value;
					}
				}		
			}
		}
	});
	//NASABAH CHANGE
	$(document).on('change', 'input[name="jenis_simpanan"]:radio', function(){
    	var jns = $(this).val();
    	if(jns == 'pokok'){
    		document.getElementsByName("nominal_simpan")[0].value = document.getElementsByName("simpanan_pokok")[0].value;
    	}
    	else if(jns == 'sukarela'){
    		document.getElementsByName("nominal_simpan")[0].value = 0;
    	}
	});
	var jnssimp = $('input[name="jenis_simpanan"]:checked').val();
});
</script>
