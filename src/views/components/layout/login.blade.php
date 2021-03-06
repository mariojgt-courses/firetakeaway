<!DOCTYPE html>
<html lang="en" class="dark" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Todo Manager' }}</title>
    <link href="{{ asset('vendor/Firetakeaway/css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    <div id="app" class="min-w-screen min-h-screen bg-white dark:bg-gray-900 flex items-center justify-center px-5 py-5" >
        @if (Auth::check())
            <x-firetakeaway::layout.navbar />
        @endif
        <div class="w-full mx-auto md:w-full md:max-w-md">
            <x-firetakeaway::layout.flash />
            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('vendor/Firetakeaway/js/app.js') }}"></script>
    <script src="{{ asset('vendor/Firetakeaway/js/vue.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            });
    </script>
    @stack('js')
</body>
</html>
