<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $company?->meta_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $company?->meta_description ?? '' }}">
    <meta name="keywords" content="{{ $company?->meta_keywords ?? '' }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" href="{{ asset('android-chrome-192x192.png') }}" type="image/png" sizes="192x192">


    <link rel="icon" href="{{ asset('android-chrome-512x512.png') }}" type="image/png" sizes="512x512">
    <link rel="icon" href="{{ asset('favicon-96x96.png') }}" type="image/png" sizes="96x96">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('og_title', config('app.name'))" />
    <meta property="og:description" content="@yield('og_description', 'Discover Worldwide Tickets & Watch Premium Live Streams for Free.')" />
    <meta property="og:image" content="@yield('og_image', asset('default-event.jpg'))" />
    <meta property="og:url" content="@yield('og_url', url('/'))" />
    <meta property="og:site_name" content="UpcomingTicket" />

    <meta name="twitter:card" content="summary_large_image">


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
        .scroll-hidden::-webkit-scrollbar {
            display: none;
        }

        .scroll-hidden {
            -ms-overflow-style: none;
            /* IE & Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        body {
            background: #0b0f14;
            color: #e6e8ee;
        }

        .glass {
            background: rgba(15, 22, 33, .7);
            border: 1px solid rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
        }

        .btn-gold {
            background: #d6b15e;
            color: #0b0f14;
            font-weight: 700;
            transition: .2s;
        }

        .btn-gold:hover {
            box-shadow: 0 0 25px rgba(214, 177, 94, .4);
            transform: translateY(-2px);
        }

        /* Trusted Stores Marquee */
        .bb-marquee {
            overflow: hidden;
            width: 100%;
        }

        .bb-track {
            display: flex;
            gap: 14px;
            width: max-content;
            animation: bb-scroll 28s linear infinite;
        }

        /* Pause when hovering anywhere inside the slider */
        .bb-marquee:hover .bb-track {
            animation-play-state: paused;
        }

        @keyframes bb-scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }

            /* because we duplicated items */
        }

        /* Store card */
        .bb-card {
            min-width: 180px;
            max-width: 220px;
            border-radius: 18px;
            padding: 14px 14px;
            background: rgba(15, 22, 33, .65);
            border: 1px solid rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .bb-card:hover {
            transform: translateY(-2px);
            border-color: rgba(214, 177, 94, .22);
            box-shadow: 0 0 18px rgba(214, 177, 94, .10);
        }

        .bb-logo {
            height: 46px;
            width: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .06);
        }

        .bb-name {
            font-weight: 800;
            font-size: 14px;
            color: #e6e8ee;
            line-height: 1.2;
        }

        /* Responsive speed tweak */
        @media (max-width: 640px) {
            .bb-track {
                animation-duration: 22s;
            }

            .bb-card {
                min-width: 160px;
            }
        }
    </style>

    @livewireStyles
</head>

<body class="min-h-screen">

    <header x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
        :class="scrolled
            ?
            'bg-[#0b0f14] border-white/10 shadow-lg' :
            'bg-transparent border-transparent'"
        class="sticky top-0 z-50 border-b transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">

            <a href="/" class="flex items-center gap-3">
                @if ($company?->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" class="h-8 w-auto">
                @endif

            </a>
            @php
                $isHome = request()->routeIs('home'); // change if needed
                $homeUrl = route('home');
            @endphp

            <div x-data="{ open: false }" class="flex items-center gap-3">

                {{-- Desktop nav --}}
                <nav class="hidden lg:flex items-center gap-8">
                    <a href="{{ $isHome ? '#why-borderless' : $homeUrl . '#why-borderless' }}"
                        class="text-gray-400 hover:text-white transition">Why Us ?</a>

                    <a href="{{ $isHome ? '#how' : $homeUrl . '#how' }}"
                        class="text-gray-400 hover:text-white transition">How it works</a>

                    <a href="{{ $isHome ? '#faq' : $homeUrl . '#faq' }}"
                        class="text-gray-400 hover:text-white transition">FAQ</a>

                    <a href="{{ $isHome ? '#contact' : $homeUrl . '#contact' }}"
                        class="text-gray-400 hover:text-white transition">Contact</a>

                    @auth
                        <a href="{{ route('user.orders') }}" class="btn-gold px-4 py-2 rounded-xl">Dashboard</a>
                    @else
                        <a href="" class="btn-gold px-4 py-2 rounded-xl">Login / Register</a>
                    @endauth
                </nav>

                {{-- Mobile hamburger --}}
                <button type="button"
                    class="lg:hidden h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center hover:bg-white/10 transition"
                    @click="open = true" aria-label="Open menu">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Backdrop --}}
                <div x-show="open" x-transition.opacity class="fixed inset-0 z-40 bg-black/60 lg:hidden"
                    @click="open = false" @keydown.escape.window="open = false"></div>

                {{-- Drawer --}}
                <aside x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="fixed right-0 top-0 h-full w-[86%] max-w-sm z-50 lg:hidden border-l border-white/10 bg-[#0b0f14] p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-white font-extrabold">Menu</div>
                        <button
                            class="h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center hover:bg-white/10 transition"
                            @click="open = false" aria-label="Close menu">
                            <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-6 space-y-2">
                        <a @click="open=false"
                            href="{{ $isHome ? '#why-borderless' : $homeUrl . '#why-borderless' }}"
                            class="block rounded-2xl px-4 py-3 text-gray-200 hover:bg-white/5 transition">
                            Why Us ?
                        </a>

                        <a @click="open=false" href="{{ $isHome ? '#how' : $homeUrl . '#how' }}"
                            class="block rounded-2xl px-4 py-3 text-gray-200 hover:bg-white/5 transition">
                            How it works
                        </a>

                        <a @click="open=false" href="{{ $isHome ? '#faq' : $homeUrl . '#faq' }}"
                            class="block rounded-2xl px-4 py-3 text-gray-200 hover:bg-white/5 transition">
                            FAQ
                        </a>

                        <a @click="open=false" href="{{ $isHome ? '#contact' : $homeUrl . '#contact' }}"
                            class="block rounded-2xl px-4 py-3 text-gray-200 hover:bg-white/5 transition">
                            Contact
                        </a>
                    </div>

                    <div class="mt-6 border-t border-white/10 pt-5">
                        @auth
                            <a href="{{ route('user.orders') }}"
                                class="btn-gold w-full px-4 py-3 rounded-2xl text-center font-bold block">
                                Dashboard
                            </a>
                        @else
                            <a href="" class="btn-gold w-full px-4 py-3 rounded-2xl text-center font-bold block">
                                Login / Register
                            </a>
                        @endauth
                    </div>

                    <p class="mt-4 text-xs text-gray-500">
                        BorderlessBazzar — Cross-border shopping for Nepal.
                    </p>
                </aside>
            </div>

        </div>
    </header>
    {{ $slot }}

    <footer id="contact" class="border-t border-white/10 bg-[#0b0f14]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 grid md:grid-cols-3 gap-10">

            {{-- Company Info --}}
            <div>
                <div class="font-extrabold text-xl">
                    {{ $company?->name ?? 'Borderless Bazzar' }}
                </div>

                <p class="text-sm text-gray-400 mt-3 max-w-sm leading-relaxed">
                    Cross-border shopping made simple for Nepal.
                    We handle shipping, customs and delivery.
                </p>

                {{-- Social Icons --}}
                <div class="flex gap-4 mt-5">

                    @if ($company?->facebook_url)
                        <a href="{{ $company->facebook_url }}" target="_blank"
                            class="h-10 w-10 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif

                    @if ($company?->instagram_url)
                        <a href="{{ $company->instagram_url }}" target="_blank"
                            class="h-10 w-10 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif

                    @if ($company?->linkedin_url)
                        <a href="{{ $company->linkedin_url }}" target="_blank"
                            class="h-10 w-10 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif

                    @if ($company?->youtube_url)
                        <a href="{{ $company->youtube_url }}" target="_blank"
                            class="h-10 w-10 flex items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif

                </div>
            </div>

            {{-- Contact Info --}}
            <div>
                <div class="font-semibold text-white">Contact</div>

                @if ($company?->contact_email)
                    <div class="text-sm mt-3 text-gray-400">
                        Email:
                        <a href="mailto:{{ $company->contact_email }}" class="text-gold hover:underline">
                            {{ $company->contact_email }}
                        </a>
                    </div>
                @endif

                @if ($company?->contact_phone)
                    <div class="text-sm mt-2 text-gray-400">
                        Phone:
                        <a href="tel:{{ $company->contact_phone }}" class="text-gold hover:underline">
                            {{ $company->contact_phone }}
                        </a>
                    </div>
                @endif

                @if ($company?->whatsapp_number)
                    <div class="text-sm mt-2 text-gray-400">
                        WhatsApp:
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp_number) }}"
                            target="_blank" class="text-gold hover:underline">
                            {{ $company->whatsapp_number }}
                        </a>
                    </div>
                @endif

                @if ($company?->address)
                    <div class="text-sm mt-2 text-gray-400">
                        {{ $company->address }}
                    </div>
                @endif
            </div>

            {{-- Quick Links (Optional Clean Column) --}}
            <div>
                <div class="font-semibold text-white">Quick Links</div>

                <div class="mt-3 space-y-2 text-sm">
                    <a href="#why-borderless" class="block text-gray-400 hover:text-white transition">Why Us</a>
                    <a href="#how" class="block text-gray-400 hover:text-white transition">How it works</a>
                    <a href="#faq" class="block text-gray-400 hover:text-white transition">FAQ</a>
                </div>
            </div>

        </div>

        {{-- Bottom --}}
        <div class="border-t border-white/10 text-center text-xs text-gray-500 py-6">
            © {{ date('Y') }} {{ $company?->name ?? 'Borderless Bazzar' }}.
            All rights reserved.
        </div>
    </footer>
    @livewire('frontend.auth-modal')


    @livewireScripts
</body>

</html>
