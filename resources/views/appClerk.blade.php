<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>e-Daftar - Sistem Penerimaan PKW</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}
    <link href="{{ asset('/css/roboto.css') }}" rel="stylesheet">

	{{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}
	<link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
    {{--<script src="//code.jquery.com/jquery-1.10.2.js"></script>--}}
    <script src="{{ asset('/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('/js/jquery-1.11.2.min.js') }}"></script>

    {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
    <script src="{{ asset('/js/jquery-ui.js') }}"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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
				<a class="navbar-brand" href="#">e - Daftar</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Utama</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Log Masuk</a></li>

					@else
					    {{--<li><a href="{{ url('admin/register') }}">Register</a></li>--}}
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Daftar PKW <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('clerk/profile') }}">Profil</a></li>
                                <li><a href="{{ url('clerk/profileExt') }}">Profil Tambahan</a></li>
                                <li><a href="{{ url('clerk/case') }}">Maklumat Kes</a></li>
                                <li><a href="{{ url('clerk/remitance') }}">Maklumat Remitan</a></li>
                                <li><a href="{{ url('clerk/parent') }}">Maklumat Waris</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Laporan <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('clerk/laporan/1') }}">m t</a></li>
                                <li><a href="{{ url('clerk/laporan/pkw1') }}">PKW Format 1</a></li>
                                <li><a href="{{ url('clerk/laporan/pkw2') }}">PKW Format 2(a)</a></li>
                                <li><a href="{{ url('clerk/laporan/pkw2b') }}">PKW Format 2(b)</a></li>
                                <li><a href="{{ url('clerk/laporan/pkw4') }}">PKW Format 4</a></li>
                                <li><a href="{{ url('clerk/laporan/remitance') }}">Remitance</a></li>



                            </ul>
                        </li>

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
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

</body>
</html>
