@php
    header( 'Cache-Control: max-age=604800' );
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="main.css" media="all">
        <link rel="icon" href="{{asset('icons/icon.png')}}" type="image/gif" sizes="16x16" media="all">	
		<link rel="stylesheet" href="{{asset('bootstrap.min.css')}}" media="all">
		<link rel="stylesheet"  href="{{asset('font-awesome.min.css')}}" media="all">
		<	<script src="{{asset('/jquery.min.js')}}"></script>
		<script src="{{asset('sweetalert2.all.min.js')}}"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		@yield('formjs')
    </head>
    <body>
		<div id="myHeader">
			<div class="boxShadow header text-left" style="font:30px Open Sans,arial,sans-serif;">
				<img src="{{asset('icons/icon.png')}}" width="50" height="50" alt=""/>
			</div>
			<div class="boxShadow-top header-sub text-left" >
				<div class="txt-title"><p>@yield('subtitle')</p></div>
			</div>
		</div>
		@yield('content2')
		<div class="content container content-wrapper2">
			<div class="row">
				@yield('content')
			</div>
		</div>
		<div id="myFooter" class="d-none d-md-block justify-content-center align-content-center">
			<div><small>Developed by I-PPerForM and FSKM</small></div>
			<div class="p-1">
				<img src="{{asset('img/logo-90x90-i-pperform.png')}}" alt=""/>
				<img src="{{asset('img/logo-90x360-uitm.png')}}" alt=""/>
			</div>
		</div>
    </body>
	@yield('message')
	
</html>