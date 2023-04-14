<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ backpack_theme_config('html_direction') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="/img/favicon-32x32.png" type="image/png"/>
    <title>{{ isset($title) ? $title.' :: '.backpack_theme_config('project_name') : backpack_theme_config('project_name') }}</title>

    @yield('before_styles')
    @stack('before_styles')

    @include(backpack_view('inc.styles'))

    @yield('after_styles')
    @stack('after_styles')

    {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
    {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="wrapper">
    @include(backpack_view('inc.menu'))
    @include(backpack_view('inc.header'))

    <div class="page-wrapper">

        @yield('before_breadcrumbs_widgets')
        @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))
        @yield('after_breadcrumbs_widgets')

        <div class="page-content">
            @yield('before_content_widgets')
            @yield('content')
            @yield('after_content_widgets')
        </div>

    </div>

    @include(backpack_view('inc.footer'))
</div>

@yield('before_scripts')
@stack('before_scripts')

@include(backpack_view('inc.scripts'))

@yield('after_scripts')
@stack('after_scripts')
</body>
</html>