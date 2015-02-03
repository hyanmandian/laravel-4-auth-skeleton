<?php 

    $assets = array(
        'javascript' => array(
            'assets/vendor/jquery/dist/jquery.min.js',
            'assets/vendor/jquery-form/jquery.form.js',
            'assets/js/scripts.js',
        ),
        'stylesheet' => array(
            'assets/vendor/normalize.css/normalize.css',
            'assets/css/style.css',
        ),
    );

?>

<!doctype html>
<html lang="{{{ Config::get('app')['locale'] }}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Publi CMS {{{ isset($pageTitle) ? "|" . $pageTitle : "" }}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @foreach ($assets['stylesheet'] as $asset)
            {{ HTML::style($asset) }}
        @endforeach

        <script> var BASEURL = "{{ URL::to('/') }}"; </script>
    </head>
    <body>

        @yield('content')
    
        @foreach ($assets['javascript'] as $asset)
            {{ HTML::script($asset) }}
        @endforeach

    </body>
</html>