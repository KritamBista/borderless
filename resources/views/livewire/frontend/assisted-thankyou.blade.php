<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assisted Order - Success</title>
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
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>



    {{-- Custom CSS --}}
    <style>
        html {
    scroll-behavior: smooth;
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
        radial-gradient(circle at 20% 10%, rgba(214,177,94,0.08), transparent 40%),
        radial-gradient(circle at 80% 90%, rgba(214,177,94,0.06), transparent 40%),
        #0b0f14;
    color: #e6e8ee;
    letter-spacing: 0.2px;
      letter-spacing: 0.2px;
  -webkit-font-smoothing: antialiased;
}
h1, h2, h3 {
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
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
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
    </style>
</head>
<body>
<section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#0b0f14] to-black px-4">

    <div class="max-w-xl w-full text-center">

        {{-- Success Icon --}}
        <div class="mx-auto h-20 w-20 rounded-full bg-gradient-to-br from-gold to-yellow-400
                    flex items-center justify-center shadow-lg shadow-yellow-500/20">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-10 w-10 text-black"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        {{-- Heading --}}
        <h1 class="mt-8 text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Order Submitted Successfully 🎉
        </h1>

        {{-- Subtext --}}
        <p class="mt-4 text-gray-400 leading-relaxed">
            Thank you for placing your assisted order with
            <span class="font-semibold text-white">BorderlessBazzar</span>.
            <br class="hidden sm:block">
            Our team will contact you shortly with the next steps.
        </p>

        {{-- Action Buttons --}}
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">

            <a href="{{ url('/') }}"
               class="px-6 py-3 rounded-xl bg-gradient-to-r from-gold to-yellow-400
                      text-black font-semibold hover:opacity-90 transition duration-300">
                Go Back Home
            </a>

            <a href="/request-order"
               class="px-6 py-3 rounded-xl border border-white/20
                      text-white hover:bg-white/10 transition duration-300">
                Place Another Order
            </a>

        </div>

    </div>

</section>

</body>
</html>
