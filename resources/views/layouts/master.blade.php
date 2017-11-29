<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Foobooks')
    </title>

    <meta charset='utf-8'>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href="/css/foobooks.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    @if(session('alert'))
        <div class='alert'> {{ session('alert') }} </div>
    @endif

    <header>
        <a href='/'><img
            src='/images/laravel-foobooks-logo@2x.png'
            style='width:300px'
            alt='Foobooks Logo'></a>

        @include('modules.nav')
    </header>

    <section id='main'>
        @yield('content')
    </section>

    <footer>
        <a href='https://github.com/milliezhou/foobooks'><i class='fa fa-github'></i></a>&nbsp;
        &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
