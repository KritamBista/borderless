<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Order Success</title>

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
</head>
<body>
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-14">

    <section class="relative overflow-hidden rounded-3xl border border-white/10 bg-[#0f141b] p-6 sm:p-10">
        {{-- soft glow --}}
        <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full bg-yellow-400/10 blur-3xl">
        </div>
        <div class="pointer-events-none absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-400/10 blur-3xl">
        </div>

        <div class="relative z-10">
            <div class="flex items-start gap-4">
                <div
                    class="h-12 w-12 rounded-2xl bg-yellow-400/10 border border-yellow-400/20 flex items-center justify-center">
                    {{-- check icon --}}
                    <svg class="h-6 w-6 text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6L9 17l-5-5" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-yellow-400/25 bg-yellow-400/10 px-3 py-1 text-xs tracking-widest uppercase text-yellow-200">
                        Order confirmed
                    </div>

                    <h1 class="mt-4 text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                        Success! Your order has been placed.
                    </h1>

                    <p class="mt-3 text-gray-300 leading-relaxed">
                        We’ve received your order and will start processing it. You can track every step — quote,
                        payment,
                        warehouse updates, and delivery — directly from your dashboard.
                    </p>

                    {{-- Optional: show order id if you have it --}}
                    @isset($order)
                        <div class="mt-6 grid sm:grid-cols-3 gap-3">
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                <div class="text-xs text-gray-400">Order ID</div>
                                <div class="mt-1 text-lg font-extrabold text-white">#{{ $order->id }}</div>
                            </div>

                            @if (isset($order->status))
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs text-gray-400">Status</div>
                                    <div class="mt-1 text-lg font-extrabold text-gold">{{ ucfirst($order->status) }}</div>
                                </div>
                            @endif

                            @if (isset($order->created_at))
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs text-gray-400">Created</div>
                                    <div class="mt-1 text-lg font-extrabold text-white">
                                        {{ $order->created_at->format('d M, Y') }}</div>
                                </div>
                            @endif
                        </div>
                    @endisset

                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('user.orders') }}"
                            class="btn-gold px-6 py-3 rounded-2xl text-center font-bold inline-flex items-center justify-center gap-2">
                            Go to Dashboard
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5-5 5M6 12h12" />
                            </svg>
                        </a>

                        <a href="{{ route('request.order') }}"
                            class="px-6 py-3 rounded-2xl text-center border border-white/15 text-white hover:bg-white/5 transition">
                            Create another order
                        </a>
                    </div>

                    <div class="mt-6 text-xs text-gray-500">
                        Tip: Keep your product links & notes updated in your dashboard to avoid delays.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Next steps --}}
    <div class="mt-8 grid sm:grid-cols-3 gap-4">
        <div class="glass rounded-2xl p-5 border border-white/10">
            <div class="text-sm font-extrabold text-white">1) Track updates</div>
            <div class="text-sm text-gray-400 mt-2">See order progress and notifications in dashboard.</div>
        </div>

        <div class="glass rounded-2xl p-5 border border-white/10">
            <div class="text-sm font-extrabold text-white">2) Confirm payment</div>
            <div class="text-sm text-gray-400 mt-2">Complete payment when requested for faster processing.</div>
        </div>

        <div class="glass rounded-2xl p-5 border border-white/10">
            <div class="text-sm font-extrabold text-white">3) Delivery to Nepal</div>
            <div class="text-sm text-gray-400 mt-2">We handle shipping + customs, deliver to your door.</div>
        </div>
    </div>

</div>

</body>
</html>
