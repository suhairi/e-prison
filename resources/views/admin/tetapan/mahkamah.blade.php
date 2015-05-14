@extends('......app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Pendaftaran Pejabat Parol </div>
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

					<br /><br />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/mahkamah') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nama Mahkamah</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mahkamah" value="{{ old('mahkamah') }}">
							</div>
						</div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Daftar Mahkamah
                                </button>
                            </div>
                        </div>

					</form>

					@if(count($mahkamahs) > 0)

					    <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bil</th>
                                    <th>Nama Mahkamah</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>

					    @foreach($mahkamahs as $key => $mahkamah)

                            <tr>
                                <td align="center">{{ ++$key }} </td>
                                <td>{{ $mahkamah->name }}</td>
                                <td>
                                    [ <a href="{{ URL::route('deleteMahkamah', $mahkamah->id) }}">Hapus </a>]
                                </td>
                            </tr>

					    @endforeach
					        <tr>
					            <td colspan="5" align="center"><?php echo $mahkamahs->render(); ?></td>
					        </tr>

					    </table>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
