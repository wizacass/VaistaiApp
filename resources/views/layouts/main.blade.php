<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <title>VaistaiApp</title>
</head>
<body>

    <nav class="navbar is-dark" role="navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">Home</a>
            <a role="button" class="navbar-burger is-active" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu is-active">
            <div class="navbar-start">
                <a class="navbar-item" href="#">TBA</a>
                <a class="navbar-item" href="#">TBA</a>
            </div>
        </div>
    </nav>

    <div style="margin: 2em">
        @yield('content')
    </div>

    <div id="app">
        <welcome></welcome>
    </div>

    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>
