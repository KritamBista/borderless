<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assisted Order - Success</title>
    <script src="https://cdn.tailwindcss.com"></script>

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
        html { scroll-behavior: smooth; }
        .scroll-hidden::-webkit-scrollbar { display: none; }
        .scroll-hidden { -ms-overflow-style: none; scrollbar-width: none; }

        body {
            background:
                radial-gradient(circle at 20% 10%, rgba(214,177,94,0.08), transparent 40%),
                radial-gradient(circle at 80% 90%, rgba(214,177,94,0.06), transparent 40%),
                #0b0f14;
            color: #e6e8ee;
            letter-spacing: 0.2px;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3 { letter-spacing: -0.02em; }

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
    </style>
</head>
<body>

<section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#0b0f14] to-black px-4">
    <div class="max-w-xl w-full text-center">

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

        <h1 class="mt-8 text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
            Revision Request Submitted Successfully 🎉
        </h1>

        <p class="mt-4 text-gray-400 leading-relaxed">
            Thank you for submitting your quote revison with
            <span class="font-semibold text-white">BorderlessBazzar</span>.
            <br class="hidden sm:block">
            Our team will contact you shortly with the next steps.
        </p>

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
