@extends('appClerk')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Profil PKW</div>
				<div class="panel-body">
				    @if(Session::has('success'))
                      <div class="alert-box success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert-box warning">{{ Session::get('success') }}</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/clerk/profile') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
                          <label class="col-md-4 control-label">Gambar</label>
                          <div class="col-sm-6">
                                <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                          </div>
                         <p class="help-block">Min saiz gambar : 2MB</p>
                       </div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" label="Nama" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">No KP</label>
							<div class="col-md-6">
							    @if(\Session::has('noPKW'))
							        <?php $noPKW = Session::get('noPKW'); ?>
                                @else
                                    <?php $noPKW = old('KP'); ?>
                                @endif
								<input type="number" class="form-control" name="noKP" label="No KP" value="{{ $noPKW }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Pekerjaan</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="jobDesc">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Keturunan</label>
							<div class="col-md-6">
                                <select class="form-control" name="race">
                                    <option value="Melayu" selected>Melayu</option>
                                    <option value="Cina">Cina</option>
                                    <option value="India">India</option>
                                    <option value="Sikh">Sikh</option>
                                    <option value="Iban">Iban</option>
                                </select>
                            </div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Agama</label>
                            <div class="col-md-6">
                                <select class="form-control" name="religion">
                                    <option value="Islam" selected>Islam</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Kristian">Kristian</option>
                                    <option value="Iban">Iban</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Telefon</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Status Perkahwinan</label>
                            <div class="col-md-6">
                                <select class="form-control" name="maritalStatus">
                                    <option value="Bujang" selected>Bujang</option>
                                    <option value="Berkahwin">Berkahwin</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Janda">Janda</option>
                                    <option value="Lain">Lain-lain</option>
                                </select>
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
