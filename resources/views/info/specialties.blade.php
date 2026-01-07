<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Kuliner Khas - Cita Rasa Samawa</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('welcome') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">Cita Rasa Samawa</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('welcome') }}">Home</a></li>
          <li><a href="{{ route('welcome') }}#about">About</a></li>
          <li><a href="{{ route('welcome') }}#menu">Menu</a></li>
          <li><a href="{{ route('welcome') }}#events">Events</a></li>
          <li><a href="{{ route('welcome') }}#chefs">UMKM</a></li>
          <li><a href="{{ route('welcome') }}#gallery">Gallery</a></li>
          <li class="dropdown"><a href="#"><span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('info.history') }}">Sejarah Kuliner</a></li>
              <li><a href="{{ route('info.specialties') }}">Kuliner Khas</a></li>
            </ul>
          </li>
          <li><a href="{{ route('welcome') }}#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="d-flex align-items-center gap-3">
        @if ($authUser)
          <span class="fw-semibold text-dark d-none d-md-inline">Hi, {{ \Illuminate\Support\Str::of($authUser->name)->explode(' ')->first() }}</span>
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn-getstarted border-0">Logout</button>
          </form>
        @else
          <a class="btn-getstarted" href="{{ route('login') }}">Login/Register</a>
        @endif
      </div>

    </div>
  </header>

  <main class="main">

    <section class="hero section light-background">
      <div class="container">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-up">
            <h1>Kuliner Khas Samawa</h1>
            <p>
              Jelajahi deretan kuliner khas Sumbawa yang kaya rempah, segar,
              dan penuh karakter. Setiap hidangan membawa rasa yang kuat
              sekaligus hangat.
            </p>
            <div class="d-flex gap-3">
              <a href="{{ route('welcome') }}#menu" class="btn-get-started">Lihat Menu</a>
              <a href="{{ route('info.history') }}" class="btn-get-started">Baca Sejarah</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="zoom-out">
            <img src="{{ asset('assets/img/menu/menu-item-1.png') }}" class="img-fluid rounded-4 shadow" alt="Kuliner khas">
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Kuliner Khas</h2>
        <p><span>Pilihan</span> <span class="description-title">Favorit Samawa</span></p>
      </div>

      <div class="container">
        @forelse ($favoriteCategories as $category)
          <div class="mb-5" data-aos="fade-up">
            <h3 class="h4 mb-3">{{ $category->heading ?? $category->name }}</h3>
            <div class="row gy-4">
              @forelse ($category->items as $item)
                @php
                  $image = $item->image_path ?: 'assets/img/menu/menu-item-1.png';
                  if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                    $image = \Illuminate\Support\Facades\Storage::url($image);
                  }
                @endphp
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                  <div class="card h-100 border-0 shadow-sm menu-favorite-card">
                    <img src="{{ $image }}" class="card-img-top menu-favorite-img" alt="{{ $item->name }}">
                    <div class="card-body">
                      <h3 class="h5">{{ $item->name }}</h3>
                      <p class="mb-2">{{ $item->description }}</p>
                      <p class="mb-0 text-danger fw-semibold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12">
                  <div class="alert alert-light">Belum ada menu favorit pada kategori ini.</div>
                </div>
              @endforelse
            </div>
          </div>
        @empty
          <div class="alert alert-light text-center">Belum ada menu favorit yang ditampilkan.</div>
        @endforelse
      </div>
    </section>

    <section class="section light-background">
      <div class="container text-center" data-aos="fade-up">
        <h2 class="mb-3">Ingin melihat menu lengkap?</h2>
        <p class="mb-4">Semua kuliner khas bisa kamu lihat di menu utama portal.</p>
        <a href="{{ route('welcome') }}#menu" class="btn-get-started">Pergi ke Menu</a>
      </div>
    </section>

  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>Sumbawa</p>
            <p>Nusa Tenggara Barat</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>0812 4788 9969</span><br>
              <strong>Email:</strong> <span>atsirdafa.nusa22@gmail.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Everyday</strong>: <span>07.00 - 22.00</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>Ac <span>Copyright</span> <strong class="px-1 sitename">Cita Rasa Samawa</strong> <span>All Rights Reserved</span></p>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
