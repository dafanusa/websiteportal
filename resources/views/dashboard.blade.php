<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Cita Rasa Samawa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
  <div class="mx-auto max-w-6xl px-4 py-10">
    <div class="rounded-3xl border border-slate-800 bg-slate-900/70 p-8 shadow-2xl">
      <p class="text-sm uppercase tracking-[0.2em] text-amber-400">Dashboard</p>
      <h1 class="mt-2 text-3xl font-semibold md:text-4xl">Halo, {{ auth()->user()->name }}.</h1>
      <p class="mt-2 text-slate-300">Role kamu: <span class="font-semibold text-amber-300">{{ auth()->user()->role }}</span></p>

      <div class="mt-8 flex flex-wrap gap-4">
        <a href="/" class="rounded-xl border border-amber-500/30 px-4 py-2 text-sm font-semibold text-amber-200 hover:border-amber-400 hover:text-amber-100">Kembali ke Home</a>
        @if (auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="rounded-xl bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-amber-400">Admin Panel</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="rounded-xl border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-200 hover:border-slate-500">
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
