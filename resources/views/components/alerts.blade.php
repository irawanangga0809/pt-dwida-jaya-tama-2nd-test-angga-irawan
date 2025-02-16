<!-- Alerts -->
@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" 
         x-show="show" x-transition.duration.500ms
         class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" 
         x-show="show" x-transition.duration.500ms
         class="fixed top-5 right-5 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session('error') }}
    </div>
@endif
