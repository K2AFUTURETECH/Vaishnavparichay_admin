<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets1/images/favicon.jpg" type="image/x-icon" />
    <title>Login</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ url('assets1/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ url('assets1/css/main.css')}}" />
    <link rel="stylesheet" href="{{ url('assets1/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ url('assets1/css/custome.login.css')}}" />



</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->


    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">


        @yield('login')

    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ url('assets1/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('assets1/js/main.js')}}"></script>
    <script src="{{ url('assets1/js/jquery-3.7.1.min.js')}}"></script>



    @stack('script')
</body>

</html>
