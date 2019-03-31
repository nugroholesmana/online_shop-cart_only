<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ url('public/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    <!-- font awesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">    
    <title>{{ env('APP_NAME', 'ngroho') }}</title>
</head>
<body>
    @yield('content')
    <!-- footer -->
    <div class="footer">
        Copyright &copy; 2019 Nugroho Lesmana Putra
    </div>
    <script src="{{ url('public/js/app.js') }}"></script>
</body>
</html>