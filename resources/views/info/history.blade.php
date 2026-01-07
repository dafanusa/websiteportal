<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sejarah Kuliner - Cita Rasa Samawa</title>
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
            <h1>Sejarah Kuliner Samawa</h1>
            <p>
              Kuliner Sumbawa lahir dari perpaduan tradisi maritim, budaya agraris,
              serta kearifan lokal yang diwariskan turun-temurun. Setiap masakan
              membawa cerita tentang kebersamaan, kesederhanaan, dan kekayaan alam.
            </p>
            <div class="d-flex gap-3">
              <a href="{{ route('info.specialties') }}" class="btn-get-started">Lihat Menu favorit</a>
              <a href="{{ route('welcome') }}#menu" class="btn-get-started">Lihat Semua Menu</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 text-center" data-aos="zoom-out">
            <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid rounded-4 shadow" alt="Sejarah kuliner">
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Jejak Rasa</h2>
        <p><span>Perjalanan</span> <span class="description-title">Kuliner Samawa</span></p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <span class="badge bg-danger rounded-pill px-3 py-2">Tradisi</span>
                  <h3 class="h5 mb-0">Warisan Leluhur</h3>
                </div>
                <p class="mb-0">
                  Resep-resep klasik diwariskan melalui keluarga, menjaga rasa
                  autentik dan teknik memasak khas Sumbawa.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <span class="badge bg-success rounded-pill px-3 py-2">Alam</span>
                  <h3 class="h5 mb-0">Hasil Bumi</h3>
                </div>
                <p class="mb-0">
                  Laut dan ladang menyediakan bahan segar, dari ikan pilihan
                  hingga rempah lokal yang kaya aroma.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <span class="badge bg-primary rounded-pill px-3 py-2">Modern</span>
                  <h3 class="h5 mb-0">Inovasi</h3>
                </div>
                <p class="mb-0">
                  Generasi baru menghadirkan sentuhan modern tanpa meninggalkan
                  cita rasa tradisionalnya.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>Nilai Kuliner</h2>
        <p><span>Kenapa</span> <span class="description-title">Begitu Istimewa</span></p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
              <h3 class="h5 mb-3">Rasa & Cerita</h3>
              <p class="mb-0">
                Kuliner Samawa bukan hanya soal rasa, tetapi juga kisah kebersamaan
                di meja makan, perayaan adat, hingga peran masyarakat pesisir.
              </p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
              <h3 class="h5 mb-3">Identitas Daerah</h3>
              <p class="mb-0">
                Setiap hidangan menjadi simbol kekuatan budaya Sumbawa yang terus
                dilestarikan oleh UMKM lokal.
              </p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
              <h3 class="h5 mb-3">Rempah Khas</h3>
              <p class="mb-0">
                Perpaduan rempah memberi rasa pedas gurih yang kuat, khas daerah
                Samawa dan sulit ditemukan di tempat lain.
              </p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="p-4 bg-white rounded-4 shadow-sm h-100">
              <h3 class="h5 mb-3">Kebersamaan</h3>
              <p class="mb-0">
                Hidangan sering disajikan untuk acara adat dan keluarga besar,
                menciptakan momen yang hangat dan bermakna.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container text-center" data-aos="fade-up">
        <h2 class="mb-3">Siap menjelajah rasa Samawa?</h2>
        <p class="mb-4">Temukan kuliner khas yang sudah diwariskan selama generasi.</p>
        <a href="{{ route('info.specialties') }}" class="btn-get-started">Lihat Kuliner Khas</a>
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
