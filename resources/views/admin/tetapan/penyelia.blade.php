@extends('......app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Pendaftaran Pegawai-pegawai </div>
				<div class="panel-body">
				    @if(Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert alert-warning">{{ Session::get('fail') }}</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/penyelia') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Daftar Penyelia
								</button>
							</div>
						</div>
					</form>

					@if(count($penyelias) > 0)

					    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bil</th>
                                    <th>Nama</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>

					    @foreach($penyelias as $index   => $penyelia)

                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $penyelia->name }}</td>
                                <td>
                                    [ <a href="{{ URL::route('deletePenyelia', $penyelia->id) }}">Hapus</a> ]
                                </td>
                            </tr>

					    @endforeach
					        <tr>
					            <td colspan="5" align="center"><?php echo $penyelias->render(); ?></td>
					        </tr>

					    </table>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
