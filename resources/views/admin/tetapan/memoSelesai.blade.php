@extends('app')


@section('content');

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Tetapan Prefix Memo Selesai</div>

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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/prefix-memo-selesai') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Prefix No Rujukan Memo Selesai</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="prefixMemoSelesai" placeholder="Contoh : JP/PRL/PKW/BLG/20/3" value="{{ old('prefixMemoSelesai') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" align="right">
                                <button type="submit" class="btn btn-primary">
                                    Daftar dan Aktif
                                </button>
                            </div>
                        </div>
                    </form>

                    <br />

                    @if(count($prefixes) > 0)

                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="4" class="success">Senarai Prefix No Rujukan Memo Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Desc</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Pilihan</th>
                        </tr>


                        @foreach($prefixes as $prefix)

                            <tr>
                                <td>{{ $prefix->desc }}</td>
                                <td>{{ $prefix->details }}</td>
                                <td>{{ $prefix->status }}</td>
                                <td>[ Aktifkan ] [ Hapus ]</td>
                            </tr>

                        @endforeach

                        </tbody>
                        </table>

                    @endif
				</div>
			</div>
		</div>
	</div>
</div>

@stop