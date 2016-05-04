<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Fandy's Project</title>

        <!-- CSS And JavaScript -->
        <link href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
        </div>

@yield('content')
</body>
</html>