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

					@if(count($penempatans) > 0)

					    {{--@foreach($penempatans as $penempatan)--}}

                        <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('kemaskiniPenempatan', $penempatans->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Organisasi</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="organisasi" value="{{ $penempatans->organisasi }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Alamat</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="alamat">{{ $penempatans->alamat }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">No Telefax</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="noTel" value="{{ $penempatans->noTel }}" placeholder="Contoh: 04-7342673">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Kemaskini Pusat Kehadiran
                                    </button>
                                </div>
                            </div>
                        </form>

                        {{--@endforeach--}}

                    @endif


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
