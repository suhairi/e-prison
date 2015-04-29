@extends('appClerk')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Maklumat Waris</div>
				<div class="panel-body">
				    @if(Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert alert-warning">{{ Session::get('success') }}</div>
                    @endif
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Perhatian!</strong> Terdapat kesalahan pada input yang dimasukkan.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/clerk/parent') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">No KP PKW</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="noKP" label="No KP" value="{{ Session::get('noPKW') }}" readonly>
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nama Waris</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" label="Nama" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">No KP Waris</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="noKPParent" label="No KP Waris" value="{{ old('noKPParent') }}" >
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-md-4 control-label">Hubungan Persaudaraan</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="relationship" placeholder="Contoh : Bapa" label="Hubungan Persaudaraan" value="{{ old('relationship') }}">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Alamat Waris</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="address" placeholder="Alamat Waris">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Telefon Waris</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Contoh : 0512345678" name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Daftar Maklumat Waris
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
