<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')

        </div>

    </body>

    <script src="{{ elixir('assets/js/foundation.js') }}"></script>

    @yield('prescript')

    <script>
        $(document).foundation();
    </script>
    
    @yield('postscript')
    
</html>
