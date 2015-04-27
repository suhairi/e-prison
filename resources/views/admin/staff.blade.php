@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Pendaftaran Pegawai-pegawai </div>
				<div class="panel-body">
				    @if(Session::has('success'))
                      <div class="alert-box success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert-box warning">{{ Session::get('fail') }}</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/staff') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">No Pekerja</label>
							<div class="col-md-6">
								<input type="number" class="form-control" pattern="[0-9]{7}" name="staffId" value="{{ old('staffId') }}" maxlength="7" size="7">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">No Kad Pengenalan</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="noKP" value="{{ old('noKP') }}" maxlength="12" size="12">
                            </div>
                        </div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Pangkat</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="pangkat" value="{{ old('pangkat') }}" placeholder="Contoh : KP; IP; WP">
                            </div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Daftar Pegawai
								</button>
							</div>
						</div>
					</form>

					@if(count($officers) > 0)

					    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pangkat</th>
                                    <th>ID Staff</th>
                                    <th>Nama</th>
                                    <th>No Kad Pengenalan</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>

					    @foreach($officers as $officer)


                            <tr>
                                <td align="center">{{ $officer->position }} </td>
                                 <td>{{ $officer->staffId }}</td>
                                <td>{{ $officer->name }}</td>
                                <td align="center">{{ $officer->noKP }}</td>
                                <td>[ Kemaskini ] [ Hapus ]</td>
                            </tr>

					    @endforeach
					        <tr>
					            <td colspan="5" align="center"><?php echo $officers->render(); ?></td>
					        </tr>

					    </table>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
