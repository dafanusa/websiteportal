<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: "Manrope", system-ui, -apple-system, "Segoe UI", sans-serif; }
    .float-in { animation: float-in 700ms ease both; }
    .float-in-delay { animation: float-in 900ms 120ms ease both; }
    .slide-up { animation: slide-up 700ms ease both; }
    .nav-sheen::after {
      content: "";
      position: absolute;
      inset: -120% auto auto -120%;
      width: 240%;
      height: 240%;
      background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.6) 50%, transparent 70%);
      transform: rotate(12deg);
      opacity: 0;
      transition: opacity 300ms ease;
    }
    .nav-sheen:hover::after { opacity: 1; }
    @keyframes float-in {
      from { opacity: 0; transform: translateY(24px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes slide-up {
      from { opacity: 0; transform: translateY(18px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(122,12,46,0.14),_#ffffff_55%,_#ffffff_100%)] text-slate-900">
  <div class="min-h-screen lg:flex">
    <aside class="relative w-full lg:w-72 bg-white/90 border-r border-[#e6d5dc] p-6 backdrop-blur lg:sticky lg:top-0 lg:h-screen">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(122,12,46,0.1),_transparent_65%)]"></div>
      <div class="relative flex h-full min-h-0 flex-col">
        <div class="float-in">
        <p class="text-xs uppercase tracking-[0.4em] text-[#7a0c2e]">Admin Suite</p>
        <h1 class="mt-3 text-2xl font-extrabold text-[#3f0818]">Cita Rasa Samawa</h1>
        <p class="mt-2 text-sm text-slate-600">Halo, {{ auth()->user()->name }}</p>
      </div>
      <nav class="mt-10 flex-1 min-h-0 space-y-3 overflow-y-auto pr-2 text-sm">
        <a href="{{ route('dashboard.items.data') }}"
          class="nav-sheen relative flex items-center gap-3 rounded-2xl px-4 py-3 font-semibold transition hover:bg-[#f7edf0] {{ request()->routeIs('dashboard.items.data') ? 'bg-white text-[#7a0c2e] shadow-sm' : 'text-slate-700' }}">
          <span class="h-9 w-9 rounded-full bg-[#f5e6eb] text-center leading-9 text-[#7a0c2e]">1</span>
          Data Menu
        </a>
        <a href="{{ route('dashboard.categories.data') }}"
          class="nav-sheen relative flex items-center gap-3 rounded-2xl px-4 py-3 font-semibold transition hover:bg-[#f7edf0] {{ request()->routeIs('dashboard.categories.data') ? 'bg-white text-[#7a0c2e] shadow-sm' : 'text-slate-700' }}">
          <span class="h-9 w-9 rounded-full bg-[#f5e6eb] text-center leading-9 text-[#7a0c2e]">2</span>
          Data Kategori
        </a>
        <a href="{{ route('dashboard.categories') }}"
          class="nav-sheen relative flex items-center gap-3 rounded-2xl px-4 py-3 font-semibold transition hover:bg-[#f7edf0] {{ request()->routeIs('dashboard.categories') ? 'bg-white text-[#7a0c2e] shadow-sm' : 'text-slate-700' }}">
          <span class="h-9 w-9 rounded-full bg-[#f5e6eb] text-center leading-9 text-[#7a0c2e]">3</span>
          Tambah Kategori
        </a>
        <a href="{{ route('dashboard.items') }}"
          class="nav-sheen relative flex items-center gap-3 rounded-2xl px-4 py-3 font-semibold transition hover:bg-[#f7edf0] {{ request()->routeIs('dashboard.items') ? 'bg-white text-[#7a0c2e] shadow-sm' : 'text-slate-700' }}">
          <span class="h-9 w-9 rounded-full bg-[#f5e6eb] text-center leading-9 text-[#7a0c2e]">4</span>
          Tambah Menu
        </a>
      </nav>
      <form method="POST" action="{{ route('logout') }}" class="mt-10">
        @csrf
        <button type="submit" class="w-full rounded-2xl border border-[#e6d5dc] bg-[#f5e6eb] px-4 py-3 text-sm font-semibold text-[#7a0c2e] transition hover:bg-[#f0dbe2]">
          Logout
        </button>
      </form>
      <div class="mt-6 text-xs text-slate-500">
        © {{ date('Y') }} Cita Rasa Samawa
      </div>
      </div>
    </aside>

    <main class="flex-1 p-6 lg:p-10">
      @if (session('status'))
        <div class="slide-up mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="slide-up mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900">
          <p class="font-semibold">Ada error</p>
          <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </main>
  </div>
</body>
</html>
