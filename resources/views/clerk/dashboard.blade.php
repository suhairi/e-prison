@extends('appClerk')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">No KP KPW</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="noKP" value="{{ Session::get('noPKW') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" align="right">
                                <button type="submit" class="btn btn-primary">
                                    Carian
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(count(@$profiles) > 0)

                        <table class="table table-hover">

                        @foreach($profiles as $profile)

                            <thead>
                                <tr>
                                    <th colspan="2">Profil PKW</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th colspan="2"><img src="uploads/images/{{ $profile->photo }}" width="120" height="150"></th>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $profile->nama }}</td>
                            </tr>
                            <tr>
                                <th>No KP</th>
                                <td>{{ $profile->noKP }}</td>
                            </tr>
                            <tr>
                                <th>Bangsa</th>
                                <td>{{ $profile->race }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $profile->religion }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $profile->jobDesc }}</td>
                            </tr>
                        @endforeach

                        @foreach($cases as $case)

                            <tr>
                                <th>No Kes</th>
                                <td>{{ $case->caseNo }}</td>
                            </tr>
                            <tr>
                                <th>Memo Terima</th>
                                <td>{{ $case->memoTerima }}</td>
                            </tr>
                            <tr>
                                <th>Memo Polis</th>
                                <td>{{ $case->memoPolis }}</td>
                            </tr>
                            <tr>
                                <th>Memo Selesai</th>
                                <td>{{ $case->memoSelesai }}</td>
                            </tr>
                            <tr>
                                <th>No Daftar</th>
                                <td>{{ $case->noDaftar }}</td>
                            </tr>
                            <tr>
                                <th>Tarikh Masuk</th>
                                <td>{{ $case->tarikhMasuk }}</td>
                            </tr>
                        @endforeach


                        </tbody>
                            </table>
                    @endif

                    @if(count(@$profiles) <= 0)

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2"><font color="red">Tiada data!</font></th>
                                </tr>
                            </thead>
                        </table>


                    @endif

                </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
