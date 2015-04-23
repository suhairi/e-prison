@extends('appClerk')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Profil Tambahan PKW</div>
				<div class="panel-body">
				    @if(Session::has('success'))
                      <div class="alert-box success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert-box warning">{{ Session::get('success') }}</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/clerk/profileExt') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">No KP</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="noKP" value="{{ Session::get('noPKW') }}" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Warna Rambut</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="hairColor" placeholder="Hitam">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Warna Kulit</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="skinColor">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Berat (KG)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="weight" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tinggi (cm)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="height" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tempat Lahir</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="placeOB">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Pendidikan</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="education">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tanda Lahir</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="marks">
                            </div>
                        </div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Simpan dan Seterusnya >>
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
