@extends('appClerk')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Maklumat Remitan</div>
				<div class="panel-body">
				    @if(Session::has('success'))
                      <div class="alert-box success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert-box warning">{{ Session::get('fail') }}</div>
                    @endif
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					{{--{{ Session::get('caseNo') }}--}}

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/clerk/remitance') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">No KP</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="noKP" value="{{ Session::get('noPKW') }}" readonly>
							</div>
						</div>

                        <div class="form-group">
							<label class="col-md-4 control-label">No Kes</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="caseNo" value="{{ Session::get('caseNo') }}" readonly>
							</div>
						</div>
						{{--
						        Tarikh Jatuh Hukum = Tarikh Masuk/Daftar
                        --}}
						<div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Jatuh Hukum</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="datepicker1" name="tarikhHukum" readonly value="{{ Session::get('tarikhMasuk') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Hukuman (bulan)</label>

                            <div class="col-md-6">
                                <select name="hukuman" id="hukuman">
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Lewat Tamat PKW</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="datepicker2" name="tarikhLewat" readonly value="{{ old('tarikhLewat') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Awal Tamat PKW</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="datepicker3" name="tarikhAwal" readonly value="{{ old('tarikhAwal') }}">
                                                              </div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Daftar Maklumat Remitan
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<script>

//$.fn.datepicker.defaults.format = 'yyyy-mm-dd';

$(function() {
    $( "#datepicker1" ).datepicker({
        changeMonth: true,
        changeYear: true,
        startDate: '+3m'
    });
});

$(function() {
    $( "#datepicker2" ).datepicker({
        changeMonth: true,
        changeYear: true
    });
});

$(function() {
    $( "#datepicker3" ).datepicker({
        changeMonth: true,
        changeYear: true
    });
});


$(function() {
    $("#hukuman").change(function() {

        var tarikhLewatSplit = $('#datepicker1').val().split('/');

        /*
         *  Tarikh Lewat
         */
        tarikhLewatSplit[0] = parseInt(tarikhLewatSplit[0]) + parseInt($("#hukuman").val());
        tarikhLewatSplit[1] = parseInt(tarikhLewatSplit[1]) - 1;

        if(tarikhLewatSplit[0] < 10)
            tarikhLewatSplit[0] = '0' + tarikhLewatSplit[0];

        if(tarikhLewatSplit[1] < 10)
            tarikhLewatSplit[1] = '0' + tarikhLewatSplit[1];

        var tarikhLewat = tarikhLewatSplit[0] + '/' + tarikhLewatSplit[1] + '/' + tarikhLewatSplit[2];


        /*
         *  Tarikh Awal
         */

        var remitan = 5 * parseInt($('#hukuman').val());

        var d = new Date(tarikhLewat);

        d.setDate(d.getDate()-remitan);

        var tarikhAwalHari  = d.getDate() + 1;
        var tarikhAwalBulan = d.getMonth() + 1;
        var tarikhAwalTahun = d.getUTCFullYear();

        if(tarikhAwalHari < 10)
            tarikhAwalHari = '0' + tarikhAwalHari;

        if(tarikhAwalBulan < 10)
            tarikhAwalBulan = '0' + tarikhAwalBulan;

        var tarikhAwal = tarikhAwalBulan + '/' + tarikhAwalHari + '/' + tarikhAwalTahun;

//        alert(tarikhAwal);

        $('#datepicker2').val(tarikhLewat);
        $('#datepicker3').val(tarikhAwal);
    })
});


</script>



@endsection
