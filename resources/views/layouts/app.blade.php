<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $company?->meta_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $company?->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $company?->meta_keywords ?? '' }}">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom Gold Theme Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: '#d6b15e',
                        darkbg: '#0b0f14',
                        darkcard: '#0f1621'
                    }
                }
            }
        }
    </script>

    {{-- Custom CSS --}}
    <style>
        body {
            background: #0b0f14;
            color: #e6e8ee;
        }
        .glass {
            background: rgba(15,22,33,.7);
            border: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(10px);
        }
        .btn-gold {
            background: #d6b15e;
            color: #0b0f14;
            font-weight: 700;
            transition: .2s;
        }
        .btn-gold:hover {
            box-shadow: 0 0 25px rgba(214,177,94,.4);
            transform: translateY(-2px);
        }
    </style>

    @livewireStyles
</head>
<body class="min-h-screen">

    {{ $slot }}
@livewire('frontend.auth-modal')
    @livewireScripts
</body>
</html>
