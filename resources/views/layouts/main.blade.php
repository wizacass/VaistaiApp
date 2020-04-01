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

    <div id="vueMenu">
        <mainmenu></mainmenu>
    </div>

    <div style="margin: 2em">
        @yield('content')
    </div>

    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>
