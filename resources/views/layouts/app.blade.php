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
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); } /* because we duplicated items */
}

/* Store card */
.bb-card {
  min-width: 180px;
  max-width: 220px;
  border-radius: 18px;
  padding: 14px 14px;
  background: rgba(15,22,33,.65);
  border: 1px solid rgba(255,255,255,.08);
  backdrop-filter: blur(10px);
  transition: 0.2s;
  display: flex;
  align-items: center;
  gap: 12px;
}

.bb-card:hover {
  transform: translateY(-2px);
  border-color: rgba(214,177,94,.22);
  box-shadow: 0 0 18px rgba(214,177,94,.10);
}

.bb-logo {
  height: 46px;
  width: 46px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.06);
}

.bb-name {
  font-weight: 800;
  font-size: 14px;
  color: #e6e8ee;
  line-height: 1.2;
}

/* Responsive speed tweak */
@media (max-width: 640px) {
  .bb-track { animation-duration: 22s; }
  .bb-card { min-width: 160px; }
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
