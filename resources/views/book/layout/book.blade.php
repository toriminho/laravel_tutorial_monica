<html>
<head>
    <title>Laravel Sample</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="row">
@yield('header')
</header>
<main>
@yield('content')
</main>
<footer>
    <div>
        R Monica
    </div>
</footer>
</body>
</html>