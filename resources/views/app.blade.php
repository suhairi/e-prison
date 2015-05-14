<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>e-Prison - Sistem Penerimaan PKW</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}
	<link href="{{ asset('/css/roboto.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
		<script src="{{ asset('js/html5shiv.js') }}"></script>

		{{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
		<script src="{{ asset('js/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">e - Prison</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Utama</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Log Masuk</a></li>

					@else

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tetapan
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('admin/register') }}">Pendaftaran Pengguna Sistem</a></li>
                                <li><a href="{{ url('admin/staff') }}">Daftar Pegawai</a> </li>
                                <li><a href="{{ url('admin/penyelia') }}">Daftar Penyelia</a> </li>
                                <li><a href="{{ url('admin/penempatan') }}">Penempatan</a> </li>
                                <li><a href="{{ url('admin/mahkamah') }}">Mahkamah</a> </li>

                                <li class="dropdown-submenu">
                                <a href="#">Prefix</a>
                                <ul class="dropdown-menu">
                                    {{--<li><a href="{{ url('admin/prefix-no-kes') }}">No Kes</a> </li>--}}
                                    <li><a href="{{ url('admin/prefix-memo-terima') }}">No Memo Terima</a> </li>
                                    <li><a href="{{ url('admin/prefix-memo-polis') }}">No Memo Polis</a> </li>
                                    <li><a href="{{ url('admin/prefix-memo-selesai') }}">No Memo Selesai</a> </li>
                                </ul>
                              </li>
                            </ul>
                        </li>

                        <li><a href="#">Jana Borang</a></li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Log Keluar</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->

	{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	{{--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
