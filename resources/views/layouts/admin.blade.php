<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Clinica</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="https://kit.fontawesome.com/4e3c5501e7.js" crossorigin="anonymous"></script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition login-page">
<div class="wrapper" id="app">

    

    <div class="login-box">
        
        <div class="login-logo">
            <a href=""><b>Admin</b>LTE</a>
        </div>
    
        <main class="py-4">
            @yield('content')
        </main>

    </div>


    
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
