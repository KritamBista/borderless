<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

</head>
<body>

<body>

<div class="min-h-screen">

    {{-- Mobile Topbar --}}
    <div class="lg:hidden border-b border-white/10 backdrop-blur-md"
         style="background: rgba(11,15,20,.65);">
        <div class="px-4 py-3 flex items-center justify-between">

            {{-- Menu Icon --}}
            <button onclick="toggleSidebar()"
                class="text-white text-xl">
                ☰
            </button>

            <div class="font-extrabold text-white">Dashboard</div>

  <a href="{{ route('logout.confirm') }}"
   class="text-gold font-bold">
    Logout
</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex relative">

        {{-- Desktop Sidebar --}}
        <aside class="hidden lg:flex w-72 min-h-screen p-5">
            <div class="w-full glass rounded-3xl p-5">
                @include('partials.dashboard-menu')
            </div>
        </aside>

        {{-- Mobile Sidebar Drawer --}}
        <div id="mobileSidebar"
             class="fixed inset-0 z-[999] hidden lg:hidden">

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/70"
                 onclick="toggleSidebar()"></div>

            {{-- Drawer --}}
            <div class="absolute left-0 top-0 h-full w-[85%] max-w-sm p-4">
                <div class="glass rounded-3xl p-5 h-full">

                    <div class="flex justify-between items-center mb-6">
                        <div class="font-extrabold text-white">Menu</div>
                        <button onclick="toggleSidebar()"
                            class="text-gray-400 hover:text-white">
                            ✕
                        </button>
                    </div>

                    @include('partials.dashboard-menu')

                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <main class="flex-1 p-4 lg:p-8">
            {{ $slot }}
        </main>

    </div>
</div>

{{-- Sidebar Toggle Script --}}
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('mobileSidebar');
        sidebar.classList.toggle('hidden');
    }
</script>

</body>
</body>
</html>
