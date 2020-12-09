<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tu blog | CMS</title>

    {{-- **** PLUGINS DE CSS **** --}}
    
    {{-- BOOSRTAP 4 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    {{-- OVERLAY SCROLL --}}
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/OverlayScrollbars.min.css">

    {{-- CSS ADMINLTE --}}
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/adminlte.min.css">

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    {{-- **** PLUGINS DE JS **** --}}

    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    {{-- FONTAWESOME --}}
    <script src="https://kit.fontawesome.com/d7f2292dd8.js" crossorigin="anonymous"></script>

    {{-- JS AdminLTE --}}
    <script src="{{ url('/') }}/js/plugins/adminlte.js"></script>

    {{-- jquery.overlayScrollbars.min.js --}}
    <script src="{{ url('/') }}/js/plugins/jquery.overlayScrollbars.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('modules/header')
        @include('modules/sidebar')
        @include('pages/home')
        @include('modules/footer')

    </div>

</body>

</html>