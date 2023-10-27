<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitoring dan Evaluasi | DPKP Bandung </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Bootstrap core CSS -->

    <link href="{{url('/backend')}}/assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{url('/backend')}}/assets/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/backend')}}/assets/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{url('/backend')}}/assets/css/custom.css" rel="stylesheet">
    <link href="{{url('/backend')}}/assets/css/icheck/flat/green.css" rel="stylesheet">


    <script src="{{url('/backend')}}/assets/js/jquery.min.js"></script>
    <script src="{{url('/backend')}}/assets/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    @yield('content')

</body>

</html>