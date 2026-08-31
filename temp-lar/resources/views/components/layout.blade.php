<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <title>Dashboard</title>

</head>




<body class="bg-slate-50 text-slate-900">
    <x-navbar></x-navbar>

    <main class="mx-auto max-w-7xl px-4 pb-10 pt-24 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>

</html>