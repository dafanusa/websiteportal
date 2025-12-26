<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | Cita Rasa Samawa</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: "Montserrat", system-ui, -apple-system, "Segoe UI", sans-serif; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-amber-50 text-slate-900">
  <div class="mx-auto flex min-h-screen max-w-6xl items-center justify-center px-4 py-10">
    <div class="grid w-full gap-8 lg:grid-cols-[1.05fr_0.95fr] items-center">
      <div class="space-y-4">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Cita Rasa Samawa</p>
        <h1 class="text-4xl font-bold leading-tight text-slate-900 md:text-5xl">Buat akun baru.</h1>
        <p class="text-base text-slate-600 md:text-lg">
          Daftar untuk mulai mengelola UMKM, menu kuliner, dan aktivitas komunitas.
        </p>
      </div>

      <div class="rounded-3xl border border-emerald-100 bg-white/80 p-8 shadow-xl backdrop-blur">
        <h2 class="text-2xl font-semibold text-slate-900">Registrasi</h2>
        <p class="mt-1 text-sm text-slate-500">Lengkapi data untuk membuat akun.</p>

        @if ($errors->any())
          <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <p class="font-semibold">Gagal registrasi</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form class="mt-6 space-y-4" method="POST" action="{{ route('register') }}">
          @csrf
          <div>
            <label for="name" class="text-sm font-medium text-slate-700">Nama Lengkap</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required
              class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100">
          </div>

          <div>
            <label for="email" class="text-sm font-medium text-slate-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
              class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100">
          </div>

          <div>
            <label for="password" class="text-sm font-medium text-slate-700">Password</label>
            <input id="password" name="password" type="password" required
              class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100">
          </div>

          <div>
            <label for="password_confirmation" class="text-sm font-medium text-slate-700">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
              class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100">
          </div>

          <button type="submit"
            class="w-full rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-500">
            Daftar
          </button>
        </form>

        <p class="mt-6 text-sm text-slate-600">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="font-semibold text-emerald-700 hover:text-emerald-600">Login sekarang</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
