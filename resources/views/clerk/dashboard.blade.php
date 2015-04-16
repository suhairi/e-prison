@extends('appClerk')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">

				    @if(Session::has('noPKW'))
				        {{ Session::get('noPKW') }}
                    @endif

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

                </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
