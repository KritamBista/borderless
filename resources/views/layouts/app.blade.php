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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        .btn-dark {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.10);
            color: white;
            transition: all .2s ease;
        }

        .btn-dark:hover {
            background: rgba(255, 255, 255, 0.10);
        }

        .blog-content h1,
        .blog-content h2,
        .blog-content h3,
        .blog-content h4 {
            font-weight: 800;
            color: white;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .blog-content h1 {
            font-size: 2rem;
        }

        .blog-content h2 {
            font-size: 1.75rem;
        }

        .blog-content h3 {
            font-size: 1.5rem;
        }

        .blog-content p {
            margin-bottom: 1.2rem;
        }

        .blog-content a {
            color: #facc15;
            text-decoration: underline;
        }

        .blog-content a:hover {
            opacity: 0.8;
        }

        .blog-content ul,
        .blog-content ol {
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .blog-content blockquote {
            border-left: 4px solid #facc15;
            padding-left: 1rem;
            margin: 1.5rem 0;
            color: #ccc;
        }

        .blog-content img {
            border-radius: 1rem;
            margin: 2rem 0;
        }
    </style>

    <style>
        /* World map background (inline SVG) */
        .world-map-bg {
            position: relative;
            overflow: hidden;
        }

        .world-map-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;

            /* Inline SVG world map (subtle, outline style) */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 600'%3E%3Cg fill='none' stroke='%23d6b15e' stroke-opacity='0.45' stroke-width='2'%3E%3Cpath d='M76 350c40-40 60-90 110-110 70-30 120 10 140 50 30 60-40 120-80 140-60 30-130 10-170-20-20-15-30-35 0-60z'/%3E%3Cpath d='M330 210c40-30 90-60 160-40 60 18 90 60 70 110-15 40-55 70-105 85-70 20-150-5-180-40-25-30-5-70 55-115z'/%3E%3Cpath d='M610 170c80-40 190-40 270 10 75 45 95 120 40 170-55 52-160 70-250 55-75-12-140-55-135-115 3-45 25-85 75-120z'/%3E%3Cpath d='M860 380c60-40 150-35 190 10 35 40 15 95-40 120-60 28-150 20-190-20-35-35-20-80 40-110z'/%3E%3Cpath d='M520 390c35-25 90-35 135-10 40 22 45 60 10 85-40 30-110 35-155 10-35-20-30-55 10-85z'/%3E%3C/g%3E%3C/svg%3E");

            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;

            opacity: 0.12;
            filter: blur(0.2px);
            transform: scale(1.08);
            pointer-events: none;
        }

        /* Dark readability overlay */
        .world-map-bg::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(circle at 50% 35%, rgba(11, 15, 20, 0.25) 0%, rgba(11, 15, 20, 0.75) 62%, rgba(11, 15, 20, 0.92) 100%),
                radial-gradient(circle at 20% 10%, rgba(214, 177, 94, 0.10), transparent 40%),
                radial-gradient(circle at 80% 90%, rgba(214, 177, 94, 0.08), transparent 40%);
            pointer-events: none;
        }
    </style>

    {{-- Custom CSS --}}
    <style>
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            width: 100%;
        }

        .scroll-hidden::-webkit-scrollbar {
            display: none;
        }

        .scroll-hidden {
            -ms-overflow-style: none;
            /* IE & Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* body {
            background: #0b0f14;
            color: #e6e8ee;
        } */
        body {
            background:
                radial-gradient(circle at 20% 10%, rgba(214, 177, 94, 0.08), transparent 40%),
                radial-gradient(circle at 80% 90%, rgba(214, 177, 94, 0.06), transparent 40%),
                #0b0f14;
            color: #e6e8ee;
            letter-spacing: 0.2px;
            letter-spacing: 0.2px;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            width: 100%;
        }


        h1,
        h2,
        h3 {
            letter-spacing: -0.02em;
        }

        /* .glass {
            background: rgba(15, 22, 33, .7);
            border: 1px solid rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
        } */
        .glass {
            background: rgba(15, 22, 33, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
        }

        /* .btn-gold {
            background: #d6b15e;
            color: #0b0f14;
            font-weight: 700;
            transition: .2s;
        } */

        /* .btn-gold:hover {
            box-shadow: 0 0 25px rgba(214, 177, 94, .4);
            transform: translateY(-2px);
        } */

        .btn-gold {
            background: linear-gradient(135deg, #d6b15e, #f0d58a);
            color: #0b0f14;
            font-weight: 700;
            transition: all .25s ease;
            box-shadow: 0 6px 18px rgba(214, 177, 94, .25);
        }

        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(214, 177, 94, .45);
        }

        /* .bb-marquee {
            overflow: hidden;
            width: 100%;
        } */
        .bb-marquee {
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }

        .bb-track {
            display: flex;
            gap: 14px;
            width: max-content;
        }

        /* Direction 1: Left */
        .bb-left {
            animation: bb-scroll-left 28s linear infinite;
        }

        /* Direction 2: Right */
        .bb-right {
            animation: bb-scroll-right 28s linear infinite;
        }

        .bb-marquee:hover .bb-track {
            animation-play-state: paused;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeUp {
            animation: fadeUp .7s ease-out forwards;
        }


        @keyframes bb-scroll-right {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes bb-scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Pause when hovering anywhere inside the slider */
        .bb-marquee:hover .bb-track {
            animation-play-state: paused;
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

        .nav-active {
            position: relative;
        }

        .nav-active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            width: 4px;
            height: 4px;
            background: #d6b15e;
            border-radius: 9999px;
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

        .glass-depth {
            background: linear-gradient(180deg,
                    rgba(255, 255, 255, 0.03) 0%,
                    rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(6px);
        }

        .hero-step-glow {
            position: relative;
        }

        icon circle: from-[#f7c443] to-[#f2a51a] title: #f0a62a description: rgba(255, 255, 255, 0.82) arrow: rgba(242, 165, 26, 0.75) .hero-step-glow::before {
            content: "";
            position: absolute;
            inset: -18px;
            border-radius: 9999px;
            background: radial-gradient(circle, rgba(214, 177, 94, 0.16) 0%, rgba(214, 177, 94, 0.05) 45%, transparent 72%);
            z-index: -1;
        }
        .hero-step-icon {
    position: relative;
    box-shadow:
        0 10px 30px rgba(242, 165, 26, 0.22),
        0 0 0 1px rgba(255, 214, 102, 0.10);
}

.hero-step-icon::before {
    content: "";
    position: absolute;
    inset: -10px;
    border-radius: 9999px;
    background: radial-gradient(circle,
            rgba(244, 170, 34, 0.22) 0%,
            rgba(244, 170, 34, 0.10) 42%,
            transparent 72%);
    z-index: -1;
}
    </style>


    @livewireStyles
</head>

<body class="  w-full min-h-screen">

    @php
        $waRaw = $company?->whatsapp_number ?? '';
        $waNumber = preg_replace('/[^0-9]/', '', $waRaw);
        $waText = urlencode('Hi! I need help with placing an order.');
    @endphp

    @if ($waNumber)
        <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" rel="noopener"
            aria-label="Chat on WhatsApp"
            class="fixed z-[9999] right-4 sm:right-6 bottom-[calc(env(safe-area-inset-bottom)+92px)] sm:bottom-[calc(env(safe-area-inset-bottom)+24px)]
              h-14 w-14 sm:h-16 sm:w-16 rounded-full flex items-center justify-center
              shadow-[0_18px_45px_rgba(0,0,0,0.45)]
              border border-white/10
              bg-[#25D366] text-white
              transition duration-200 hover:scale-105 active:scale-95">
            <i class="fa-brands fa-whatsapp text-2xl sm:text-3xl"></i>
        </a>
    @endif
    <header x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
        :class="scrolled
            ?
            'bg-[#0b0f14]/95 backdrop-blur-xl border-white/10 shadow-[0_8px_30px_rgba(0,0,0,0.4)]' :
            'bg-transparent border-transparent'"
        class="sticky top-0 z-50 border-b transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">

            <a href="/" class="flex items-center gap-3">
                @if ($company?->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}"
                        class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto object-contain transition-transform duration-200 hover:scale-105">
                @endif
            </a>


            @php
                $isHome = request()->routeIs('home'); // change if needed
                $homeUrl = route('home');
            @endphp

            <div $store.ui.mobileMenu class="flex items-center gap-3">

                {{-- Desktop nav --}}
                <nav class="hidden lg:flex items-center gap-8">



                    <a href="{{ $isHome ? '#how' : $homeUrl . '#how' }}"
                        class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">How it
                        works</a>

                    <a href="{{ $isHome ? '#faq' : $homeUrl . '#faq' }}"
                        class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">FAQ</a>

                    <a href="/blogs"
                        class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">Blogs</a>
                    <a href="/guides"
                        class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">Guides</a>
                    @auth
                        <a href="{{ route('user.orders') }}"
                            class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">Dashboard</a>
                    @else
                        {{-- <a href=""
                            class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">Login /
                            Register</a> --}}
                        <a href="#" onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))"
                            class="text-gray-400 hover:text-white transition duration-300 hover:-translate-y-0.5">
                            Login / Register
                        </a>
                    @endauth
                </nav>
                <a href="/request-order" class="hidden ml-4 btn-gold px-4 py-2 rounded-xl lg:flex items-start gap-2 ">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Order
                </a>

                {{-- Mobile hamburger --}}
                <button type="button"
                    class="lg:hidden h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center hover:bg-white/10 transition"
                    @click="$store.ui.mobileMenu = true" aria-label="Open menu">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Backdrop --}}
                <div x-show= "$store.ui.mobileMenu" x-transition.opacity
                    class="fixed inset-0 z-40 bg-black/60 lg:hidden"
                    @click="$store.ui.mobileMenu = false     @keydown.escape.window="$store.ui.mobileMenu=false"></div>

                {{-- Drawer --}}
                <aside x-show="$store.ui.mobileMenu" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="fixed right-0 top-0 h-full w-[86%] max-w-sm z-50 lg:hidden border-l border-white/10 bg-[#0b0f14] p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-white font-extrabold">Menu</div>
                        <button
                            class="h-10 w-10 rounded-xl border border-white/10 bg-white/5 flex items-center justify-center hover:bg-white/10 transition"
                            @click="$store.ui.mobileMenu = false" aria-label="Close menu">
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
                            <a href="#" onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))"
                                class="btn-gold w-full px-4 py-3 rounded-2xl text-center font-bold block">
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
    <main>
        {{ $slot }}

    </main>

    <footer id="contact" class="relative overflow-hidden text-white">
        {{-- Background --}}
        <div class="absolute inset-0">
            <div
                class="absolute inset-0 bg-[url('/footer.png')] bg-no-repeat bg-cover
                   bg-[position:72%_85%]
                   sm:bg-[position:70%_82%]
                   lg:bg-[position:right_bottom]">
            </div>

            {{-- readability layers --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/80 to-black/30"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/72 via-black/35 to-black/20"></div>
            <div class="absolute inset-0 bg-black/18"></div>
        </div>

        {{-- Content --}}
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div
                class="pt-20 sm:pt-24 lg:pt-28 pb-16 sm:pb-20 lg:pb-24 grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">
                {{-- Company Info --}}
                <div class="max-w-sm">
                    <div class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        <span class="text-white">
                            {{ $company?->name ?? 'BorderlessBazzar' }}
                        </span>
                    </div>

                    <p class="text-sm sm:text-base mt-4 leading-8 text-white/90">
                        Cross-border shopping made simple for Nepal.
                        We handle shipping, customs and delivery.
                    </p>

                    <div class="flex gap-4 mt-6">
                        @foreach ([
        'facebook_url' => 'fab fa-facebook-f',
        'instagram_url' => 'fab fa-instagram',
        'linkedin_url' => 'fab fa-linkedin-in',
        'youtube_url' => 'fab fa-youtube',
    ] as $field => $icon)
                            @if ($company?->$field)
                                <a href="{{ $company->$field }}" target="_blank"
                                    class="h-10 w-10 flex items-center justify-center rounded-xl
                                       bg-white/10 backdrop-blur-md border border-white/10
                                       hover:bg-white/20 transition duration-300">
                                    <i class="{{ $icon }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- Contact --}}
                <div class="max-w-sm">
                    <div class="font-semibold text-white text-xl">Contact</div>

                    <div class="mt-5 space-y-3 text-sm sm:text-base text-white/90">
                        @if ($company?->contact_email)
                            <div>
                                Email:
                                <a href="mailto:{{ $company->contact_email }}"
                                    class="hover:text-white underline underline-offset-4 break-all">
                                    {{ $company->contact_email }}
                                </a>
                            </div>
                        @endif

                        @if ($company?->contact_phone)
                            <div>
                                Phone:
                                <a href="tel:{{ $company->contact_phone }}"
                                    class="hover:text-white underline underline-offset-4">
                                    {{ $company->contact_phone }}
                                </a>
                            </div>
                        @endif

                        @if ($company?->whatsapp_number)
                            <div>
                                WhatsApp:
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp_number) }}"
                                    target="_blank" class="hover:text-white underline underline-offset-4">
                                    {{ $company->whatsapp_number }}
                                </a>
                            </div>
                        @endif

                        @if ($company?->address)
                            <div>
                                {{ $company->address }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="max-w-sm">
                    <div class="font-semibold text-white text-xl">Quick Links</div>

                    <div class="mt-5 space-y-3 text-sm sm:text-base">
                        <a href="#why-borderless" class="block text-white/90 hover:text-white transition">
                            Why Us
                        </a>
                        <a href="#how" class="block text-white/90 hover:text-white transition">
                            How it works
                        </a>
                        <a href="#faq" class="block text-white/90 hover:text-white transition">
                            FAQ
                        </a>
                        <a href="/blogs" class="block text-white/90 hover:text-white transition">
                            Blogs
                        </a>
                        <a href="/guides" class="block text-white/90 hover:text-white transition">
                            Guides
                        </a>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="relative border-t border-white/15 py-6 text-center text-sm text-white/70">
                © {{ date('Y') }}
                <span class="font-bold text-white">
                    {{ $company?->name ?? 'BorderlessBazzar' }}
                </span>.
                All rights reserved.
            </div>
        </div>
    </footer>
    {{-- @livewire('frontend.auth-modal') --}}
    <livewire:frontend.auth-modal />



    @livewireScripts
    {{-- <nav class="lg:hidden fixed  bottom-[env(safe-area-inset-bottom)] left-0 w-full z-50">

        <div class="bg-[#0b0f14]/80  backdrop-blur-xl border-t border-white/5">

            <div class="relative flex items-end justify-between px-4 sm:px-8 pt-3 pb-2">

                <a href="/"
                    class="flex flex-col items-center justify-end flex-1 gap-1 transition duration-200
               {{ request()->is('/') ? 'text-gold' : 'text-gray-400' }}">
                    <i class="fas fa-house text-lg"></i>
                    <span class="text-[10px] tracking-wide">Home</span>
                </a>

                @auth
                    <a href="{{ route('user.orders') }}"
                        class="flex flex-col items-center mr-8 justify-end flex-1 gap-1 transition duration-200
               {{ request()->routeIs('user.orders') ? 'text-gold' : 'text-gray-400' }}">
                        <i class="fas fa-box text-lg"></i>
                        <span class="text-[10px] tracking-wide">My Profile</span>
                    </a>
                @else
                    <a href="#" onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))"
                        class="flex flex-col items-center justify-end flex-1 gap-1 text-gray-400 transition duration-200">
                        <i class="fa-solid fa-right-to-bracket text-lg"></i>
                        <span class="text-[10px] tracking-wide">Login</span>
                    </a>
                @endauth


                <div class="absolute left-1/2 -translate-x-1/2 -top-6 shadow-[0_15px_40px_rgba(214,177,94,0.45)]">

                    <a href="/request-order"
                        class="h-16 w-16 rounded-2xl bg-gold text-[#0b0f14]
                          flex items-center justify-center
                          shadow-[0_8px_30px_rgba(212,175,55,0.35)]
                          ring-4 ring-[#0b0f14]
                          active:scale-95 transition duration-200">

                        <i class="fas fa-plus text-xl"></i>
                    </a>

                    <p class="text-[10px] text-center mt-1 text-gray-400">Create</p>

                </div>



                <a href="/blogs"
                    class="flex flex-col items-center justify-end flex-1 gap-1 ml-8 transition duration-200
               {{ request()->is('blogs') ? 'text-gold' : 'text-gray-400' }}">
                    <i class="fas fa-book text-lg"></i>
                    <span class="text-[10px] tracking-wide">Blogs</span>
                </a>

                <a href="/blogs"
                    class="flex flex-col items-center justify-end flex-1 gap-1  transition duration-200
               {{ request()->is('blogs') ? 'text-gold' : 'text-gray-400' }}">
                    <i class="fa-solid fa-compass text-lg"></i>
                    <span class="text-[10px] tracking-wide">Guides</span>
                </a>




            </div>
        </div>
    </nav> --}}
    <nav class="lg:hidden fixed bottom-[env(safe-area-inset-bottom)] left-0 w-full z-50">
        <div class="bg-[#0b0f14]/80 backdrop-blur-xl border-t border-white/5">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 pt-2 pb-2">
                <div class="grid grid-cols-5 items-end gap-1">

                    {{-- Home --}}
                    <a href="/"
                        class="flex flex-col items-center justify-end gap-1 py-1 transition duration-200
                   {{ request()->is('/') ? 'text-gold' : 'text-gray-400' }}">
                        <i class="fas fa-house text-[18px] sm:text-lg"></i>
                        <span class="text-[10px] sm:text-[11px] leading-none">Home</span>
                    </a>

                    {{-- Orders / Login --}}
                    @auth
                        <a href="{{ route('user.orders') }}"
                            class="flex flex-col items-center justify-end gap-1 py-1 transition duration-200
                       {{ request()->routeIs('user.orders') ? 'text-gold' : 'text-gray-400' }}">
                            <i class="fas fa-box text-[18px] sm:text-lg"></i>
                            <span class="text-[10px] sm:text-[11px] leading-none">Profile</span>
                        </a>
                    @else
                        <a href="#" onclick="window.dispatchEvent(new CustomEvent('open-auth-modal'))"
                            class="flex flex-col items-center justify-end gap-1 py-1 text-gray-400 transition duration-200">
                            <i class="fa-solid fa-right-to-bracket text-[18px] sm:text-lg"></i>
                            <span class="text-[10px] sm:text-[11px] leading-none">Login</span>
                        </a>
                    @endauth

                    <div class="flex flex-col items-center -mt-6">
                        <a href="/request-order"
                            class="h-14 w-14 sm:h-16 sm:w-16 rounded-2xl bg-gold text-[#0b0f14]
                              flex items-center justify-center
                              {{-- shadow-[0_8px_30px_rgba(212,175,55,0.35)] --}}
                              ring-4 ring-[#0b0f14]
                              active:scale-95 transition duration-200">
                            <i class="fas fa-plus text-lg sm:text-xl"></i>
                        </a>
                        <p class="text-[10px] sm:text-[11px] mt-1 text-gray-400 leading-none">Create</p>
                    </div>

                    {{-- Blogs --}}
                    <a href="/blogs"
                        class="flex flex-col items-center justify-end gap-1 py-1 transition duration-200
                   {{ request()->is('blogs') ? 'text-gold' : 'text-gray-400' }}">
                        <i class="fas fa-book text-[18px] sm:text-lg"></i>
                        <span class="text-[10px] sm:text-[11px] leading-none">Blogs</span>
                    </a>

                    {{-- Guides --}}
                    <a href="/guides"
                        class="flex flex-col items-center justify-end gap-1 py-1 transition duration-200
                   {{ request()->is('guides') ? 'text-gold' : 'text-gray-400' }}">
                        <i class="fa-solid fa-compass text-[18px] sm:text-lg"></i>
                        <span class="text-[10px] sm:text-[11px] leading-none">Guides</span>
                    </a>

                </div>
            </div>
        </div>
    </nav>







    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('ui', {
                mobileMenu: false
            })
        })
    </script>

    <script>
        function reviewSlider() {
            return {
                atStart: true,
                atEnd: false,
                track: null,

                init() {
                    this.track = this.$refs.track;
                    this.updateButtons();

                    window.addEventListener('resize', () => {
                        this.updateButtons();
                    });
                },

                scrollAmount() {
                    const firstCard = this.track.querySelector('[class*="snap-start"]');
                    if (!firstCard) return 300;

                    const gap = 24; // approximate gap
                    return firstCard.offsetWidth + gap;
                },

                scrollLeft() {
                    this.track.scrollBy({
                        left: -this.scrollAmount(),
                        behavior: 'smooth'
                    });

                    setTimeout(() => this.updateButtons(), 350);
                },

                scrollRight() {
                    this.track.scrollBy({
                        left: this.scrollAmount(),
                        behavior: 'smooth'
                    });

                    setTimeout(() => this.updateButtons(), 350);
                },

                updateButtons() {
                    const el = this.track;
                    if (!el) return;

                    this.atStart = el.scrollLeft <= 5;
                    this.atEnd = el.scrollLeft + el.clientWidth >= el.scrollWidth - 5;
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            const startCounting = (counter) => {
                const target = +counter.getAttribute('data-target');
                let count = 0;

                const update = () => {
                    const increment = target / speed;

                    if (count < target) {
                        count += increment;
                        // counter.innerText = Math.ceil(count);
                        counter.innerText = Math.ceil(count).toLocaleString();
                        requestAnimationFrame(update);
                    } else {
                        counter.innerText = target.toLocaleString() + "+";
                    }
                };

                update();
            };


            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounting(entry.target);
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.6
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });

        });
    </script>
    <script>
        window.addEventListener('open-auth-modal', () => {
            Livewire.dispatch('open-auth-modal');
        });
    </script>
    <script>
        window.addEventListener('scroll-to-proceed', () => {
            setTimeout(() => {
                const el = document.getElementById('proceed-section');
                if (el) {
                    el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }, 150);
        });
    </script>

</body>

</html>
