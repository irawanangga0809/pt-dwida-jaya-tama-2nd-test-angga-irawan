<!DOCTYPE html>
<html lang="en">
    @include('components.head')
<body class="bg-gray-900 text-white">


    <div class="container mx-auto px-6 py-4">
        
        <!-- Navbar -->
        @include('components.navbar')

        @yield('content')
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
