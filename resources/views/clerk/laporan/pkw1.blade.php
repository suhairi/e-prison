@extends('appClerk')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Laporan PKW 1</div>
				<div class="panel-body">

				    @if(Session::has('message'))
                        <div class="alert alert-warning">{{ Session::get('message') }}</div>
                    @endif

				    @if(Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                      <div class="alert alert-warning">{{ Session::get('fail') }}</div>
                    @endif
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


					<form class="form-horizontal" role="form" method="POST" action="{{ url('clerk/laporan/pkw1') }}" target="_blank">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    <div class="form-group">
                        <label class="col-md-4 control-label">No KP</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="noKP" value="{{ Session::get('noPKW') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">No Kes PKW</label>
                        <div class="col-md-6">
                            <select class="form-control" name="noKes">
                                <option value="">Pilih No Kes</option>
                                @foreach($cases as $case)
                                    <option value="{{ $case->caseNo }}">{{ $case->caseNo }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Jana Laporan PKW 1
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


@stop