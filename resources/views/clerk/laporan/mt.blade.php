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

				<form method="post" action="#" role="form">
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
                                <td>Pegawai Pusat Kehadiran Wajib Daerah
                                    <select class="kehadiran" name="kehadiran">
                                        <option value="" selected>Pusat Kehadiran</option>

                                        @foreach($kehadirans as $kehadiran)
                                            <option value="{{ $kehadiran->id }}">{{ $kehadiran->desc }}</option>
                                        @endforeach

                                    </select>
                                    <font class="negeri">&nbsp;</font>
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
                                <td>
                                    <select class="memoTerima" name="memoTerima">
                                        <option value="" selected>Rujukan Fail</option>

                                        @foreach($cases as $case)
                                            <option value="{{ $case->id }}">{{ $case->memoTerima }}</option>
                                        @endforeach

                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Tarikh</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td><font class="tarikh"></font></td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top"><strong>Perkara</strong></td>
                                <td valign="top"><strong>:</strong></td>
                                <td><strong>PENERIMAAN PESALAH KEHADIRAN WAJIB DAERAH <font class="daerah"></font> </strong></td>
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
                                                        <td colspan="2" style="border-bottom: solid 1px #000"><font class="noDaftar"></font></td>
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
                                            <td colspan="2">
                                                <select name="pegawai">
                                                    <option value="" selected>Pegawai Bertugas</option>

                                                    @foreach($officers as $officer)
                                                        <option value="{{ $officer->name }}">{{ $officer->name }} ( {{ $officer->position }} )</option>
                                                    @endforeach

                                                </select>

                                            </td>
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
				</form>

                <br /><br />

                <form method="post" action="#" role="form">
                    <table width="80%" border="0" style="border : solid 1px #000">
                        <tr>
                            <td align="center" colspan="3"><img src="{{ asset('images/logo_penjara.png') }}" border="0"></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="3">BORANG PENGHANTARAN DOKUMEN</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="3">TERPERINGKAT SULIT/TERHAD MELALUI FAKSIMILI</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>

                        {{--###################################################################--}}

                        <tr align="left">
                            <td colspan="3">

                                <table align="center" width="90%" style="border : 1px solid #000">
                                    <tr>
                                        <td valign="top" colspan="4">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td valign="top" colspan="4"><strong>MAKLUMAT DOKUMEN</strong></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>No Rujukan</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="noRujukan"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>Tarikh Dokumen Dihantar</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="tarikhDokumen"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>Perkara/Tajuk</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td>Penerimaan Pesalah Kehadiran Wajib <font class="daerah2"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>Tarikh</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="tarikh"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>Perkara</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><strong>PENERIMAAN PESALAH KEHADIRAN WAJIB DAERAH <font class="daerah"></font> </strong></td>
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
                                                                <td colspan="2" style="border-bottom: solid 1px #000"><font class="noDaftar"></font></td>
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
                                                    <td colspan="2">
                                                        <select name="pegawai">
                                                            <option value="" selected>Pegawai Bertugas</option>

                                                            @foreach($officers as $officer)
                                                                <option value="{{ $officer->name }}">{{ $officer->name }} ( {{ $officer->position }} )</option>
                                                            @endforeach

                                                        </select>

                                                    </td>
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
                </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {

    $('.kehadiran').change(function(e) {

        e.preventDefault();

        var strData = $('.kehadiran').val();
        var url = "{{ URL::route('ajax') }}";
            url += '/kehadiran/negeri/' + strData;

        if(strData != '') {
                $.ajax({
                    type    : 'GET',
                    url     : url,
                    data    : strData,
                    success : function(data) {
                        $('.negeri').html(data);
                    }
                }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += '/kehadiran/daerah/' + strData;

//        alert(url);

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.daerah').html(data);
                }
            }, 'json');
        }

    })

    $('.memoTerima').change(function(e) {

        e.preventDefault();

        var strData = $('.memoTerima').val();
        var url = "{{ URL::route('ajax') }}";
            url += "/cases/tarikh/" + strData;

        if(strData != '') {
                $.ajax({
                    type    : 'GET',
                    url     : url,
                    data    : strData,
                    success : function(data) {
                        $('.tarikh').html(data);
                    }
                }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/cases/noDaftar/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.noDaftar').html(data);
                }
            }, 'json');
        }

    })

})


</script>


@stop