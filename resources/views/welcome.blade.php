<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Cita Rasa Samawa</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">Cita Rasa Samawa</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#menu">Menu</a></li>
          <li><a href="#events">Events</a></li>
          <li><a href="#chefs">UMKM</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li class="dropdown"><a href="#"><span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{ route('info.history') }}">Sejarah Kuliner</a></li>
              <li><a href="{{ route('info.specialties') }}">Kuliner Khas</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
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

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Menyelami<br>Cita Rasa Samawa</h1>
            <p data-aos="fade-up" data-aos-delay="100">Eksplorasi kuliner khas Sumbawa yang lahir dari budaya, alam, dan tradisi masyarakat Samawa.</p>
            <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
              <a href="#menu" class="btn-get-started">Jelajahi Kuliner</a>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us<br></h2>
        <p><span>Tentang</span> <span class="description-title">Cita Rasa Samawa</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid mb-6" alt="">
            <div class="book-a-table"> 
            <h3>Kuliner Khas Sumbawa</h3> 
            <p>Asli dari Sumbawa!</p> 
        </div>
          </div>
          <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                Cita Rasa Samawa adalah platform digital yang menghadirkan kekayaan kuliner khas Sumbawa sebagai identitas budaya dan warisan lokal.
              </p>
              <ul>
                <li><i class="bi bi-check-circle-fill"></i> <span>Kuliner tradisional autentik.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Dukungan UMKM lokal.</span></li>
                <li><i class="bi bi-check-circle-fill"></i> <span>Pelestarian budaya Samawa.</span></li>
              </ul>
              <p>
              Website ini menjadi etalase kuliner daerah yang menghubungkan cerita, rasa, dan pelaku kuliner dalam satu pengalaman digital yang modern dan informatif.
              </p>

              <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section light-background">

  <div class="container">

    <div class="row gy-4">

      <!-- Why Box -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box">
          <h3>{{ $whySection['title'] ?? $whySection->title }}</h3>
          <p>
            {{ $whySection['description'] ?? $whySection->description }}
          </p>
          @php
            $whyButtonLabel = $whySection['button_label'] ?? $whySection->button_label ?? null;
            $whyButtonLink = $whySection['button_link'] ?? $whySection->button_link ?? null;
          @endphp
          @if ($whyButtonLabel && $whyButtonLink)
            <div class="text-center">
              <a href="{{ $whyButtonLink }}" class="more-btn">
                <span>{{ $whyButtonLabel }}</span>
                <i class="bi bi-chevron-right"></i>
              </a>
            </div>
          @endif
        </div>
      </div>
      <!-- End Why Box -->

      <div class="col-lg-8 d-flex align-items-stretch">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

          @foreach ($whyItems as $index => $item)
            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="{{ 200 + ($index * 100) }}">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="{{ $item['icon_class'] ?? $item->icon_class }}"></i>
                <h4>{{ $item['title'] ?? $item->title }}</h4>
                <p>
                  {{ $item['description'] ?? $item->description }}
                </p>
              </div>
            </div>
          @endforeach

        </div>
      </div>

    </div>

  </div>

</section>

<!-- Stats Section -->
<section id="stats" class="stats section dark-background">

  <img src="assets/img/stats-bg.jpg" alt="" data-aos="fade-in">

  <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      @foreach ($stats as $stat)
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0"
                  data-purecounter-end="{{ $stat['value'] ?? $stat->value }}"
                  data-purecounter-duration="1"
                  class="purecounter"></span>
            <p>{{ $stat['label'] ?? $stat->label }}</p>
          </div>
        </div>
      @endforeach

    </div>

  </div>

</section>
<!-- /Stats Section -->


    <!-- Menu Section -->
    <section id="menu" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Samawa Menu</h2>
        <p><span>Jelajahi</span> <span class="description-title">Kuliner Khas Samawa</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          @foreach ($menuCategories as $category)
            <li class="nav-item">
              <a class="nav-link @if ($loop->first) active show @endif" data-bs-toggle="tab" data-bs-target="#menu-{{ $category->slug }}">
                <h4>{{ $category->name }}</h4>
              </a>
            </li>
          @endforeach
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          @forelse ($menuCategories as $category)
            <div class="tab-pane fade @if ($loop->first) active show @endif" id="menu-{{ $category->slug }}">
              <div class="tab-header text-center">
                <p>Menu</p>
                <h3>{{ $category->heading ?? $category->name }}</h3>
              </div>

              <div class="row gy-5">
                @forelse ($category->items as $item)
                  @php
                    $image = $item->image_path ?: 'assets/img/menu/menu-item-1.png';
                    if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                      $image = \Illuminate\Support\Facades\Storage::url($image);
                    }
                  @endphp
                  <div class="col-lg-4 menu-item">
                    <a href="{{ $image }}" class="glightbox">
                      <img src="{{ $image }}" class="menu-img img-fluid" alt="{{ $item->name }}">
                    </a>
                    <h4>{{ $item->name }}</h4>
                    <p class="ingredients">
                      {{ $item->description }}
                    </p>
                    <p class="price">
                      Rp {{ number_format($item->price, 0, ',', '.') }}
                    </p>
                  </div>
                @empty
                  <div class="col-lg-12">
                    <p class="text-center">Menu belum tersedia.</p>
                  </div>
                @endforelse
              </div>
            </div>
          @empty
            <div class="tab-pane fade active show" id="menu-empty">
              <div class="tab-header text-center">
                <p>Menu</p>
                <h3>Menu belum tersedia</h3>
              </div>
            </div>
          @endforelse
        </div>

      </div>

    </section><!-- /Menu Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>TESTIMONIALS</h2>
        <p>What Are They <span class="description-title">Saying About Us</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">
            @forelse ($testimonials as $testimonial)
              @php
                $image = $testimonial->photo_path ?: 'assets/img/testimonials/testimonials-1.jpg';
                if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                  $image = \Illuminate\Support\Facades\Storage::url($image);
                }
              @endphp
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="row gy-4 justify-content-center">
                    <div class="col-lg-6">
                      <div class="testimonial-content">
                        <p>
                          <i class="bi bi-quote quote-icon-left"></i>
                          <span>{{ $testimonial->content }}</span>
                          <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                        <h3>{{ $testimonial->name }}</h3>
                        <h4>Pengunjung</h4>
                        <div class="stars">
                          @for ($i = 0; $i < ($testimonial->rating ?? 5); $i++)
                            <i class="bi bi-star-fill"></i>
                          @endfor
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 text-center">
                      <div class="testimonial-avatar">
                        <img src="{{ $image }}" class="img-fluid testimonial-img" alt="{{ $testimonial->name }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End testimonial item -->
            @empty
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="row gy-4 justify-content-center">
                    <div class="col-lg-8">
                      <div class="testimonial-content text-center">
                        <p>Belum ada testimoni. Jadilah yang pertama berbagi cerita!</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforelse
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Events Section -->
    <section id="events" class="events section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>EVENTS</h2>
        <p><span>Acara</span> <span class="description-title">Spesial Samawa</span></p>
      </div><!-- End Section Title -->

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">
            @foreach ($events as $event)
              @php
                $image = $event->image_path ?: 'assets/img/events-1.jpg';
                if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                  $image = \Illuminate\Support\Facades\Storage::url($image);
                }
              @endphp
              <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url({{ $image }})">
                <h3>{{ $event->title }}</h3>
                @if ($event->price_label)
                  <div class="price align-self-start">{{ $event->price_label }}</div>
                @endif
                <p class="description">
                  {{ $event->description }}
                </p>
              </div><!-- End Event item -->
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Events Section -->

    <!-- Chefs Section -->
<section id="chefs" class="chefs section">

  <div class="container section-title" data-aos="fade-up">
    <h2>Tokoh Kuliner</h2>
    <p><span>Pelaku</span> <span class="description-title">Kuliner Samawa</span></p>
  </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          @foreach ($umkms as $umkm)
            @php
              $image = $umkm->image_path ?: 'assets/img/chefs/chefs-1.jpg';
              if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                $image = \Illuminate\Support\Facades\Storage::url($image);
              }
            @endphp
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
              <div class="chef-member">
                <div class="member-img">
                  <img src="{{ $image }}" class="img-fluid" alt="{{ $umkm->name }}">
                </div>
                <div class="member-info">
                  <h4>{{ $umkm->name }}</h4>
                  <span>{{ $umkm->specialty }}</span>
                  <p>
                    {{ $umkm->description }}
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>

    </section><!-- /Chefs Section -->



    <!-- Gallery Section -->
    <section id="gallery" class="gallery section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p><span>Check</span> <span class="description-title">Our Gallery</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            @foreach ($galleries as $gallery)
              @php
                $image = $gallery->image_path ?: 'assets/img/gallery/gallery-1.jpg';
                if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                  $image = \Illuminate\Support\Facades\Storage::url($image);
                }
              @endphp
              <div class="swiper-slide">
                <a class="glightbox" data-gallery="images-gallery" href="{{ $image }}">
                  <img src="{{ $image }}" class="img-fluid" alt="{{ $gallery->title ?? 'Gallery' }}">
                </a>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Gallery Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p><span>Need Help?</span> <span class="description-title">Contact Us</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-5">
          <iframe class="w-100 border-0 rounded-4 shadow-sm" style="height: 400px;" src="https://www.google.com/maps?q=Sumbawa,+Nusa+Tenggara+Barat,+Indonesia&output=embed" allowfullscreen="" loading="lazy"></iframe>
          <div class="mt-3 text-center">
            <a href="https://www.google.com/maps?q=Sumbawa,+Nusa+Tenggara+Barat,+Indonesia" target="_blank" rel="noopener noreferrer" class="btn-get-started">
              Buka di Google Maps
            </a>
          </div>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="icon bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Address</h3>
                <p>Sumbawa</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>WhatsApp</h3>
                <p>0812 4788 9969</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email</h3>
                <p>atsirdafa.nusa22@gmail.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
              <i class="icon bi bi-clock flex-shrink-0"></i>
              <div>
                <h3>Opening Hours<br></h3>
                <p>07.00 - 22.00</p>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="php-email-form" data-aos="fade-up" data-aos-delay="600">
          @if ($authUser)
            <form id="contactForm" class="row gy-4">
              <div class="col-md-6">
                <input type="text" id="contactName" name="name" class="form-control" placeholder="Nama" value="{{ $authUser->name }}" required>
              </div>
              <div class="col-md-6">
                <input type="email" id="contactEmail" name="email" class="form-control" placeholder="Email" value="{{ $authUser->email }}" required>
              </div>
              <div class="col-md-12">
                <input type="text" id="contactSubject" name="subject" class="form-control" placeholder="Subject" required>
              </div>
              <div class="col-md-12">
                <textarea id="contactMessage" name="message" class="form-control" rows="6" placeholder="Message" required></textarea>
              </div>
              <div class="col-md-12 text-center d-flex flex-column flex-md-row justify-content-center gap-3">
                <button type="button" class="btn-getstarted bg-danger text-white" data-contact-action="gmail">
                  Kirim via Gmail
                </button>
                <button type="button" class="btn-getstarted bg-success text-white" data-contact-action="whatsapp">
                  Kirim via WhatsApp
                </button>
              </div>
            </form>
          @else
            <div class="text-center">
              <p class="mb-3">Silakan login untuk mengirim pesan.</p>
              <a href="{{ route('login') }}" class="btn-get-started">Login</a>
            </div>
          @endif
        </div><!-- End Contact Form -->

      </div>

    </section><!-- /Contact Section -->

    <!-- Testimonial Form Section -->
    <section id="testimonial-form" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>TESTIMONI</h2>
        <p><span>Bagikan</span> <span class="description-title">Pengalamanmu</span></p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if (session('testimonial_status'))
          <div class="mb-4 alert alert-success">
            {{ session('testimonial_status') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="mb-4 alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if ($authUser)
          <form action="{{ route('testimonials.store') }}" method="post" class="row gy-4" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
              <input type="text" name="name" class="form-control" placeholder="Nama" value="{{ old('name', $authUser->name) }}" required>
            </div>
            <div class="col-md-6">
              <select name="rating" class="form-control" required>
                <option value="">Pilih Rating</option>
                @for ($star = 5; $star >= 1; $star--)
                  <option value="{{ $star }}" @selected(old('rating') == $star)>{{ $star }} Bintang</option>
                @endfor
              </select>
            </div>
            <div class="col-12">
              <textarea name="content" class="form-control" rows="5" placeholder="Tulis testimoni kamu..." required>{{ old('content') }}</textarea>
            </div>
            <div class="col-12">
              <input type="file" name="photo" class="form-control">
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn-get-started">Kirim Testimoni</button>
            </div>
          </form>
        @else
          <div class="text-center">
            <p class="mb-3">Silakan login untuk memberikan testimoni.</p>
            <a href="{{ route('login') }}" class="btn-get-started">Login</a>
          </div>
        @endif
      </div>
    </section><!-- /Testimonial Form Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>Sumbawa, Nusa Tenggara</p>
            <p>Indonesia, 19990</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>081247889969</span><br>
              <strong>Email:</strong> <span>citarasasamawa@gmail.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Waktu Buka</h4>
            <p>
              <strong>Senin-Sabtu:</strong> <span>11AM - 23PM</span><br>
              <strong>Minggu</strong>: <span>Tutup</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Ikuti Kami</h4>
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
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Cita Rasa Samawa</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">CitaRasaSamawa</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    const contactForm = document.getElementById('contactForm');

    if (contactForm) {
      const getValue = (id) => {
        const field = document.getElementById(id);
        return field ? field.value.trim() : '';
      };

      const buildPayload = () => ({
        name: getValue('contactName'),
        email: getValue('contactEmail'),
        subject: getValue('contactSubject'),
        message: getValue('contactMessage'),
      });

      const buildText = (payload) => {
        return `Nama: ${payload.name}
Email: ${payload.email}
Subjek: ${payload.subject}

${payload.message}`;
      };

      const buttons = document.querySelectorAll('[data-contact-action]');
      buttons.forEach((button) => {
        button.addEventListener('click', () => {
          const payload = buildPayload();
          if (!payload.name || !payload.email || !payload.subject || !payload.message) {
            alert('Lengkapi form terlebih dahulu.');
            return;
          }

          const subject = encodeURIComponent(payload.subject);
          const body = encodeURIComponent(buildText(payload));

          if (button.dataset.contactAction === 'gmail') {
            window.location.href = `mailto:atsirdafa.nusa22@gmail.com?subject=${subject}&body=${body}`;
            return;
          }

          const text = encodeURIComponent(buildText(payload));
          window.open(`https://wa.me/6281247889969?text=${text}`, '_blank');
        });
      });
    }
  </script>

</body>


</html>
