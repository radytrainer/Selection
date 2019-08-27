
@include('layout.header')

    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    @stack('scripts')
    
@include('layout.footer')


