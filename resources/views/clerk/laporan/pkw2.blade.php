@extends('appClerk')

@section('content')

<style>

table {
    padding-top: 10px;
    padding-left: 10px;
    padding-right: 10px;
    padding-bottom: 10px;
}

td {
    padding-left: 5px;
    font-family: arial, helvetica, sans-serif;
}




</style>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Janaan Laporan PKW 1</div>

				<div class="panel-body" align="center">

				<form method="post" action="{{ url('clerk/laporan/mt/1') }}" target="_blank" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-group">
                    <label class="col-md-4 control-label">Mahkamah</label>
                    <div class="col-md-6">
                        <select name="mahkamah">
                            <option value="">Senarai Mahkamah</option>
                        </select>
                    </div>
                </div>


                </form>

                </div>
            </div>
        </div>
    </div>
</div>

@stop