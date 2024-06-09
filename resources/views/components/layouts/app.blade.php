<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{--@livewireStyles--}}
    @stack('styles')
    @stack('scripts')
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
{{ $slot }}
{{--@livewireScriptConfig--}}
<script>
    document.addEventListener('livewire:init', () => {
        // Runs after Livewire is loaded but before it's initialized
        // on the page...
    })

    document.addEventListener('livewire:initialized', () => {
        // Runs immediately after Livewire has finished initializing
        // on the page...
        Livewire.on('alert', ({ type,message,data={} }) => {
            Swal.fire({
                title: message,
                icon: type,
                showConfirmButton: false,
                timer: 1500
            })
        })
    })
</script>
</body>
</html>
