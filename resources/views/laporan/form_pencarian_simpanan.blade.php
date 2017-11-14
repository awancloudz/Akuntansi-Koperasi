<div id="pencarian">
	{!! Form::open(['url' => 'lapsimpanan/cari', 'method' => 'GET', 'id' => 'form_pencarian']) !!}
<div class="row">
	<div class="col-md-6">
		<div class="input-group">
		<span class="input-group-addon">Tanggal Awal - Tanggal Akhir</span>
		<!--{!! Form::text('tanggaljurnal', null,['class' => 'form-control','id'=>'tanggaljurnal']) !!}-->
		<div id="tanggaljurnal" class="pull-right" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc; width: 100%">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span></span> <b class="caret"></b>
		</div>
		{!! Form::hidden('tgl_awal', null,['id'=>'tgl_awal']) !!}
		{!! Form::hidden('tgl_akhir', null, ['id'=>'tgl_akhir']) !!}
		<span class="input-group-btn">
		{!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['class'=>'btn btn-default','id'=>'tb_cari','type'=>'submit']) !!}
		</span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box-button">
		{{ link_to('lapsimpanan/cetak','Cetak Simpanan',['class' => 'btn btn-primary','target'=>'_blank']) }}
		</div>
		<!--<div class="box-button">
		{{ link_to('lapsimpanan/ekspor','Export ke Excel',['class' => 'btn btn-success','target'=>'_blank']) }}
		</div>-->
	</div>
</div>
	{!! Form::close() !!}
</div>
<script type="text/javascript">
$(function() {

	var start = moment().startOf('month');
    var end = moment().endOf('month');

    function cb(start, end) {
        $('#tanggaljurnal span').html(start.format('D MMMM') + ' - ' + end.format('D MMMM YYYY'));
		document.getElementById("tgl_awal").value = start.format('YYYY-MM-DD');
		document.getElementById("tgl_akhir").value = end.format('YYYY-MM-DD');
    }
    $('#tanggaljurnal').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Hari Ini': [moment(), moment()],
           'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
           '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
           'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});
</script>