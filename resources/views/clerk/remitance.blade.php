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
								<input type="text" class="form-control" name="noKes" value="{{ Session::get('noKes') }}" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">No Rujukan Memo Terima</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="memoTerima">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">No Rujukan Memo Polis</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="memoPolis">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Rujukan Memo Selesai</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="memoSelesai">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Daftar</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="noDaftar">
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Tarikh Daftar</label>
                            <div class="col-md-6">
                                <input type="datetime" class="form-control" name="tarikhDaftar">
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
