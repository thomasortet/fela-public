@include('partials.head')

@yield('script-header')

<body>
@include('partials.navbar')
@yield('content')
@yield('script-footer')
</body>

</html>
