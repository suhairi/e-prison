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
				<div class="panel-heading">Laporan PKW Format 2(b)</div>

				<div class="panel-body" align="center">

				<form method="post" action="{{ url('clerk/laporan/pkw2b') }}" target="_blank" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                {{--############################         SATU         ###########################--}}
				<table width="80%" border="0" style="border : solid 1px #000">
				    <tr>
				        <td align="right">PKW Format 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				    </tr>
				    <tr>
				        <td>&nbsp;</td>
				    </tr>
				    <tr>
				        <td><strong>E. REKOD KESALAHAN LAMPAU</strong></td>
				    </tr>
				    <tr>
                        <td>&nbsp;</td>
                    </tr>
				    <tr>
				        <td>
				            <table width="80%" height="20%" style="border: 1px solid #000">
				                <tr>
				                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000" align="center"><strong>Tarikh</strong></td>
				                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000" align="center"><strong>Kesalahan</strong></td>
				                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000" align="center"><strong>Hukuman</strong></td>
				                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000" align="center"><strong>Mahkamah</strong></td>
				                    <td style="border-bottom: 1px solid #000; border-right: 1px solid #000" align="center"><strong>Penjara</strong></td>
				                </tr>
				                <tr>
                                    <td width="15" style="border-right: 1px solid #000">&nbsp</td>
                                    <td style="border-right: 1px solid #000"></td>
                                    <td style="border-right: 1px solid #000"></td>
                                    <td style="border-right: 1px solid #000"></td>
                                    <td style="border-right: 1px solid #000"></td>
                                </tr>
                                @if(count($cases) > 0)

                                    @foreach($cases as $case)
                                        <tr>
                                            <td width="15" style="border-right: 1px solid #000" align="center" valign="top">{{ $case->tarikhMasuk }}</td>
                                            <td style="border-right: 1px solid #000" align="center" valign="top">{{ $case->seksyenKesalahan }}</td>
                                            <td style="border-right: 1px solid #000" align="center" valign="top">{{ $case->hukuman }}</td>
                                            <td style="border-right: 1px solid #000" align="center" valign="top">{{ $case->name }}</td>
                                            <td style="border-right: 1px solid #000" align="center" valign="top">{{ $case->desc }}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td width="55" style="border-right: 1px solid #000">Tiada</td>
                                        <td style="border-right: 1px solid #000" align="center">Tiada</td>
                                        <td style="border-right: 1px solid #000" align="center">Tiada</td>
                                        <td style="border-right: 1px solid #000" align="center">Tiada</td>
                                        <td style="border-right: 1px solid #000" align="center">Tiada</td>
                                    </tr>
                                @endif

                                @for($i=0; $i<=(10 - count($cases)); $i++)
                                    <tr>
                                        <td width="15" style="border-right: 1px solid #000" align="center">&nbsp</td>
                                        <td style="border-right: 1px solid #000" align="center"></td>
                                        <td style="border-right: 1px solid #000" align="center"></td>
                                        <td style="border-right: 1px solid #000" align="center"></td>
                                        <td style="border-right: 1px solid #000" align="center"></td>
                                    </tr>
                                @endfor
				            </table>
				        </td>
				    </tr>
				    <tr>
				        <td>&nbsp;</td>
				    </tr>
				    <tr>
				        <td><hr /></td>
				    </tr>
				    <tr>
				        <td><strong>F. PEKERJAAN / AKTIVITI / PROGRAM YANG DITENTUKAN</strong></td>
				    </tr>
				    <tr>
                        <td>&nbsp;</td>
                    </tr>
				    <tr>
				        <td><textarea name="catatan" class="form-control" placeholder="Keterangan aktiviti..."></textarea></td>
				    </tr>
				    <tr>
				        <td>&nbsp;</td>
				    </tr>
				    <tr>
				        <td align="right">
				            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Jana Laporan PKW 2(b)
                                    </button>
                                </div>
                            </div>
				        </td>
				    </tr>
				    <tr>
                        <td>&nbsp;</td>
                    </tr>

				</table>




                </form>

                </div>
            </div>
        </div>
    </div>
</div>


@stop