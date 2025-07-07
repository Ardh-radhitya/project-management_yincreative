<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
    <title>Dashboard - Y.in Creative</title>

    @include('layout.partial.link')

  </head>

  <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    @include('layout.partial.header')

    @yield('content')

  </body>

  @include('layout.partial.script')
</html>
