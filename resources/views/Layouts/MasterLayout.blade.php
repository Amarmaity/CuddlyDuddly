<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CuddluDuddly')</title>

    {{-- ✅ Tailwind via CDN, no npm needed --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Header --}}
    {{-- @include('Layouts.Header') --}}
     @if(!isset($minimal) || !$minimal)
        @include('Layouts.Header')
    @endif

    {{-- Page Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    {{-- @include('Layouts.Footer') --}}
     @if(!isset($minimal) || !$minimal)
        @include('Layouts.Footer')
    @endif

</body>
</html>
