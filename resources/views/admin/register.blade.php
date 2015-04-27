@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Pendaftaran Pengguna Sistem </div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nama</label>
							<div class="col-md-6">
								<input type="text" class="form-control" pattern="[a-zA-Z]{50}" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Alamat E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Kata Laluan</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Pengesahan Kata Laluan</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
                            <label class="col-md-4 control-label">Pangkat Pengguna</label>
                            <div class="col-md-6">
                                <select class="form-control" name="level">
                                    <option value="1">1 - Pentadbir</option>
                                    <option value="2" selected>2 - Kerani..</option>
                                </select>
                            </div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Daftar
								</button>
							</div>
						</div>
					</form>

					@if(count($users) > 0)

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>

                        @foreach($users as $user)

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->level == 1)
                                        PENTADBIR
                                    @endif

                                    @if($user->level == 2)
                                        KERANI
                                    @endif
                                </td>
                                <td>[ Hapus ]</td>
                            </tr>

                        @endforeach

                            <tr>
                                <td colspan="4" align="center"><?php echo $users->render(); ?></td>
                            </tr>


                    @endif






				</div>
			</div>
		</div>
	</div>
</div>
@endsection
