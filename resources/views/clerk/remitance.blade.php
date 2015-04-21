@extends('appClerk')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Maklumat Remitan</div>
				<div class="panel-body">
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
								<input type="text" class="form-control" name="noKes" value="{{ Session::get('caseNo') }}" readonly>
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Jatuh Hukum</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="datepicker" name="tarikhDaftar">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Lewat Tamat PKW</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="datepicker" name="tarikhDaftar">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Awal Tamat PKW</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="datepicker" name="tarikhDaftar">
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



@endsection
