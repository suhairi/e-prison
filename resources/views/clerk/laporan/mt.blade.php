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

				<form method="post" action="{{ url('clerk/laporan/mt/1') }}" target="_blank" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                {{--############################         SATU         ###########################--}}
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
                                <td>Pegawai
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
                                                <select name="pegawai" class="officer">
                                                    <option value="" selected>Pegawai Bertugas</option>

                                                    @foreach($officers as $officer)
                                                        <option value="{{ $officer->staffId }}">{{ $officer->name }} ( {{ $officer->position }} )</option>
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



				</table>

                {{--############################         DUA         ###########################--}}

                <br /><br />

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
                                    <td><font class="noRujukan2"></font></td>
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
                                    <td valign="top"><strong>Bil Muka Surat</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td>(10) termasuk halaman ini</td>
                                </tr>

                                <tr>
                                    <td colspan="3"><hr color="#00" /></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td valign="top" colspan="4"><strong>MAKLUMAT PENERIMA</strong></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>NAMA PEGAWAI</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td>
                                        <select name="penerima" class="penerima">
                                            <option value="" selected>Nama Penerima</option>

                                            @foreach($penerimas as $penerima)
                                                <option value="{{ $penerima->id }}">{{ $penerima->name }}</option>
                                            @endforeach

                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>NAMA ORGANISASI</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="organisasiPenerima"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>ALAMAT</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="alamatPenerima"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>NO TELEFAX</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="noTelPenerima"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3"><hr color="#0FF" /></td>
                                </tr>

                                <tr>
                                    <td valign="top" colspan="4"><strong>MAKLUMAT PENGIRIM</strong></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>NAMA PEGAWAI</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="pengirim"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>NAMA ORGANISASI</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="organisasi"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>ALAMAT</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="alamat"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>NO TELEFAX</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td><font class="noTel"></font></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>PESANAN</strong></td>
                                    <td valign="top"><strong>:</strong></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>

                            </table>


                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>

                </table>

                {{--############################        TIGA        ###########################--}}
                <br /><br />

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
                                        <td><font class="noRujukan2"></font></td>
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
                                        <td valign="top"><strong>Bil Muka Surat</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="tarikh"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"><hr color="#00" /></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td valign="top" colspan="4"><strong>MAKLUMAT PENERIMA</strong></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>NAMA PEGAWAI</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td>
                                            <select name="penerima2" class="penerima2">
                                                <option value="" selected>Nama Penerima</option>

                                                @foreach($penerimas as $penerima)
                                                    <option value="{{ $penerima->id }}">{{ $penerima->organisasi }}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>NAMA ORGANISASI</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="organisasiPenerima2" </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>ALAMAT</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="alamatPenerima2" </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>NO TELEFAX</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="noTelPenerima2" </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"><hr color="#0FF" /></td>
                                    </tr>

                                    <tr>
                                        <td valign="top" colspan="4"><strong>MAKLUMAT PENGIRIM</strong></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>NAMA PEGAWAI</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="pengirim"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>NAMA ORGANISASI</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="organisasi2"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>ALAMAT</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="alamat2"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>NO TELEFAX</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td><font class="noTel2"></font></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><strong>PESANAN</strong></td>
                                        <td valign="top"><strong>:</strong></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>

                                </table>


                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>

                        <tr width="90%">
                            <td colspan="2" align="right"><input type="submit" value="Jana Laporan" class="btn btn-primary"></td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>

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

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.daerah').html(data);
                    $('.daerah2').html(data);

                }
            }, 'json');
        }
    });

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
                        $('.tarikhDokumen').html(data);
                        $('.tarikhDokumen2').html(data);
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

        var url = "{{ URL::route('ajax') }}";
        url += "/cases/noKes/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.noRujukan2').html(data);
                    $('.noRujukan3').html(data);

                }
            }, 'json');
        }

    });

    $('.officer').change(function(e){

        e.preventDefault();

        var strData = $('.officer').val();
        var url = "{{ URL::route('ajax') }}";
        url += "/officer/nama/" + strData;

//        alert(url);

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.pengirim').html(data);
                    $('.pengirim2').html(data);

                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/officer/organisasi/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.organisasi').html(data);
                    $('.organisasi2').html(data);
                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/officer/alamat/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.alamat').html(data);
                    $('.alamat2').html(data);

                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/officer/notel/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.noTel').html(data);
                    $('.noTel2').html(data);

                }
            }, 'json');
        }

    });

    $('.penerima').change(function(e) {

        e.preventDefault();

        strData = $('.penerima').val();
        var url = "{{ URL::route('ajax') }}";
        url += "/penerima/organisasi/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.organisasiPenerima').html(data);
                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/penerima/alamat/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.alamatPenerima').html(data);
                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/penerima/notel/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.noTelPenerima').html(data);
                }
            }, 'json');
        }

    });

    $('.penerima2').change(function(e) {

        e.preventDefault();

        strData = $('.penerima2').val();
        var url = "{{ URL::route('ajax') }}";
        url += "/penerima/organisasi/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.organisasiPenerima2').html(data);
                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/penerima/alamat/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.alamatPenerima2').html(data);
                }
            }, 'json');
        }

        var url = "{{ URL::route('ajax') }}";
        url += "/penerima/notel/" + strData;

        if(strData != '') {
            $.ajax({
                type    : 'GET',
                url     : url,
                data    : strData,
                success : function(data) {
                    $('.noTelPenerima2').html(data);
                }
            }, 'json');
        }

    });

})

</script>


@stop