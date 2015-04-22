@extends('appClerk')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Maklumat Kes</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/clerk/case') }}">
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
								<strong>Contoh : </strong>83RS-01-01/2014<input type="text" class="form-control" name="noKes">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">No Rujukan Memo Terima</label>
							<div class="col-md-6">
								@foreach($prefixes as $prefix)
								    @if($prefix->desc == 'memoTerima')
                                        {{ $prefix->details }}(*)
                                    @endif
								@endforeach
								<input type="text" class="form-control" name="memoTerima" maxlength="2">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">No Rujukan Memo Polis</label>
                            <div class="col-md-6">
                                @foreach($prefixes as $prefix)
                                    @if($prefix->desc == 'memoPolis')
                                        {{ $prefix->details }}(*)
                                    @endif
                                @endforeach
                                <input type="text" class="form-control" name="memoPolis" maxlength="2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Rujukan Memo Selesai</label>
                            <div class="col-md-6">
                                @foreach($prefixes as $prefix)
                                    @if($prefix->desc == 'memoTerima')
                                        {{ $prefix->details }}(*)
                                    @endif
                                @endforeach
                                <input type="text" class="form-control" name="memoSelesai" maxlength="2">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Daftar</label>
                            <div class="col-md-6">
                                <strong>Contoh : </strong>PKW 000 * - ** - 02 - 14
                                <input type="text" class="form-control" name="noDaftar">
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Daftar Masuk</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="datepicker" name="tarikhDaftar">
                            </div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Daftar Maklumat Kes
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

$(function() {
    $( "#datepicker" ).datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
});


</script>

@endsection
