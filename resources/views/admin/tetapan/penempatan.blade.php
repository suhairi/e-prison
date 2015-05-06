@extends('......app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Pendaftaran Pejabat Parol </div>
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

					<br /><br />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/penempatan') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Organisasi</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="organisasi" value="{{ old('organisasi') }}">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Alamat</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="alamat" value="{{ old('alamat') }}"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">No Telefax</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="noTel" value="{{ old('noTel') }}" placeholder="Contoh: 04-7342673">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Daftar Pusat Kehadiran
                                </button>
                            </div>
                        </div>

					</form>

					@if(count($penempatans) > 0)

					    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bil</th>
                                    <th>Organisasi</th>
                                    <th>Alamat</th>
                                    <th>No Telefax</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>

					    @foreach($penempatans as $key => $penempatan)

                            <tr>
                                <td align="center">{{ ++$key }} </td>
                                <td>{{ $penempatan->organisasi }}</td>
                                <td>{{ $penempatan->alamat }}</td>
                                <td>{{ $penempatan->noTel }}</td>
                                <td>
                                    [ <a href="{{ URL::route('kemaskiniPenempatan', $penempatan->id) }}">Kemaskini </a> ]
                                    [ <a href="{{ URL::route('deletePenempatan', $penempatan->id) }}">Hapus </a>]
                                </td>
                            </tr>

					    @endforeach
					        <tr>
					            <td colspan="5" align="center"><?php echo $penempatans->render(); ?></td>
					        </tr>

					    </table>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
