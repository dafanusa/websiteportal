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
    .text-maroon { color: #7a0c2e; }
    .bg-maroon { background-color: #7a0c2e; }
    .border-maroon { border-color: #7a0c2e; }
    .hover-maroon:hover { background-color: #5c0a22; }
  </style>
</head>
<body class="bg-gray-100 text-slate-900">
  @yield('content')
  @stack('scripts')
</body>
</html>
