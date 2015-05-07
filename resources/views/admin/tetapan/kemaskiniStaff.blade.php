@extends('......app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Kemaskini Pegawai </div>
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

					@if(count($officer) > 0)

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/staff') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $officer->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">No Pekerja</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="staffId" value="{{ $officer->staffId }}" maxlength="7" size="7">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">No Kad Pengenalan</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="noKP" value="{{ $officer->noKP }}" maxlength="12" size="12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Pangkat</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="pangkat" value="{{ $officer->position }}" placeholder="Contoh : KP; IP; WP">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Kemaskini Pegawai
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
