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
				<div class="panel-heading">Laporan MT</div>

				<div class="panel-body" align="center">

				<table width="80%" border="0" style="border : solid 1px #000">
				    <tr>
				        <td align="center" colspan="3"><img src="{{ asset('images/logo_penjara.png') }}" border="0"></td>
				    </tr>
				    <tr>
				        <td align="center" colspan="3">MEMO</td>
				    </tr>
				    <tr>
				        <td align="center" colspan="3">JABATAN PENJARA MALAYSIA</td>
				    </tr>
				    <tr>
				        <td align="center" colspan="3">PUSAT KEHADIRAN WAJIB</td>
				    </tr>
				    <tr>
				        <td colspan="3">&nbsp;</td>
				    </tr>

				    {{--###################################################################--}}

				    <tr align="left">
				        <td colspan="3">

				            <table align="center" width="90%" border="0">
				            <tr>
				                <td valign="top"><strong>Kepada</strong></td>
                                <td valign="top" width="10"><strong>:</strong></td>
                                <td>Pengarah Parol Dan Perkhidmatan Komuniti, <br />
                                    Ibu Pejabat Penjara Malaysia.
                                </td>
				            </tr>

				            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Daripada</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td>
                                    <select name="pusatKehadiran">
                                        <option value=""
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Salinan</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td>Pengarah Parol Dan Perkhidmatan Komuniti Negeri Kedah</td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Ruj. Fail</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td>{{ $cases->memoTerima }}</td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Tarikh</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td>{{ $tarikhMasuk }}</td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Perkara</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td><strong>PENERIMAAN PESALAH KEHADIRAN WAJIB DAERAH BALING/SIK</strong></td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">

                                    <table width="95%" border="0">
                                        <tr>
                                            <td colspan="2">Tuan</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Adalah saya dengan hormatnya merujuk kepada perkara di atas.</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td width="45">2.</td>
                                            <td>Bersama-sama ini disertakan :-</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <br />
                                                1) Salinan Perintah Kehadiran Wajib, <br />
                                                2) Salinan Buku Daftar PKW Format 1, <br />
                                                3) Salinan Rekod Pesalah PKW Format 2,<br/>
                                                4) Salinan Borang PKW 4,<br />
                                                5) Remitan. <br />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <table border="0" width="100%">
                                                    <tr>
                                                        <td colspan="2">bagi pesalah bernama</td>
                                                        <td colspan="3" style="border-bottom: solid 1px #000">{{ $profile->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="85">No. Daftar</td></td>
                                                        <td colspan="2" style="border-bottom: solid 1px #000">{{ $cases->noDaftar }}</td>
                                                        <td colspan="2">untuk makluman pihak tuan </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">selanjutnya.</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">Sekian, terima kasih.</td>
                                        </tr>

                                        <tr>
                                            <td><br /><br /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">Saya yang menurut perintah,</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"><br /><br /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">......................................................................</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">Mohamad Azwan Bin Bahari (IP)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><br /><br /></td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

				            </table>


				        </td>
				    </tr>

				    {{--###################################################################--}}

				</table>

                </div>
            </div>
        </div>
    </div>
</div>

@stop