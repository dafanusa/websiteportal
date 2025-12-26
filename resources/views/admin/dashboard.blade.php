@extends('layout')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="flex min-h-screen bg-gray-50">
    <aside class="w-64 bg-white shadow-lg flex flex-col border-r border-gray-100">
      <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-maroon">Admin Panel</h1>
      </div>
      <nav class="flex-1 px-4 py-6 space-y-2">
        <button id="nav-menu" onclick="showSection('menu')" class="w-full text-left px-4 py-3 rounded-xl text-slate-700 hover:bg-maroon hover:text-white transition duration-300">
          Menu Makanan
        </button>
        <button id="nav-kategori" onclick="showSection('kategori')" class="w-full text-left px-4 py-3 rounded-xl text-slate-700 hover:bg-maroon hover:text-white transition duration-300">
          Data Kategori
        </button>
        <button id="nav-umkm" onclick="showSection('umkm')" class="w-full text-left px-4 py-3 rounded-xl text-slate-700 hover:bg-maroon hover:text-white transition duration-300">
          UMKM
        </button>
        <button id="nav-event" onclick="showSection('event')" class="w-full text-left px-4 py-3 rounded-xl text-slate-700 hover:bg-maroon hover:text-white transition duration-300">
          Events
        </button>
        <button id="nav-gallery" onclick="showSection('gallery')" class="w-full text-left px-4 py-3 rounded-xl text-slate-700 hover:bg-maroon hover:text-white transition duration-300">
          Gallery
        </button>
      </nav>
      <div class="px-4 pb-4">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full px-4 py-3 rounded-xl bg-red-600 text-white hover:bg-red-700 transition duration-300">
            Logout
          </button>
        </form>
      </div>
      <div class="p-4 border-t text-gray-500 text-sm">
        &copy; {{ date('Y') }} Cita Rasa Samawa
      </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-6 lg:p-8">
      @if (session('status'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-900">
          <p class="font-semibold">Ada error</p>
          <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="mb-6">
        <h1 class="text-3xl font-bold text-maroon">Dashboard Admin</h1>
      </div>

      <section id="section-menu" class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <h2 class="text-2xl font-semibold text-slate-800">Menu Makanan</h2>
          <button onclick="openMenuCreate()" class="bg-maroon text-white px-5 py-2 rounded-full hover-maroon transition transform hover:scale-105 duration-300">
            + Tambah
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($items as $item)
            @php
              $image = $item->image_path ?: 'assets/img/menu/menu-item-1.png';
              if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                $image = \Illuminate\Support\Facades\Storage::url($image);
              }
            @endphp
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center transition duration-300 hover:shadow-lg">
              <div class="w-full h-44 mb-4 rounded-xl overflow-hidden border border-gray-100">
                <img src="{{ $image }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
              </div>
              <h3 class="font-semibold text-lg text-maroon">{{ $item->name }}</h3>
              <p class="text-sm text-gray-500">Category: {{ $item->category?->name ?? 'Tanpa kategori' }}</p>
              <p class="font-semibold text-maroon">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
              <p class="text-sm text-gray-600 mt-2 mb-4">{{ $item->description }}</p>
              <div class="flex gap-2">
                <button
                  class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                  data-action="{{ route('dashboard.items.update', $item) }}"
                  data-category="{{ $item->menu_category_id }}"
                  data-name="{{ $item->name }}"
                  data-price="{{ $item->price }}"
                  data-description="{{ $item->description }}"
                  data-sort="{{ $item->sort_order }}"
                  data-active="{{ $item->is_active ? '1' : '0' }}"
                  data-image="{{ $image }}"
                  onclick="openMenuEdit(this)"
                >Edit</button>
                <form id="delete-menu-{{ $item->id }}" method="POST" action="{{ route('dashboard.items.destroy', $item) }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" onclick="openConfirm('Hapus menu', 'Hapus menu ini?', 'delete-menu-{{ $item->id }}')" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
                </form>
              </div>
            </div>
          @empty
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">Belum ada menu.</div>
          @endforelse
        </div>
      </section>

      <section id="section-kategori" class="mt-10 hidden space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <h2 class="text-2xl font-semibold text-slate-800">Data Kategori</h2>
          <button onclick="openCategoryCreate()" class="bg-maroon text-white px-5 py-2 rounded-full hover-maroon transition transform hover:scale-105 duration-300">
            + Tambah
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($categories as $category)
            <div class="bg-white rounded-2xl shadow-md p-4 transition duration-300 hover:shadow-lg">
              <div class="space-y-2">
                <h3 class="font-semibold text-lg text-maroon">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500">{{ $category->heading ?? 'Tanpa heading' }}</p>
                <p class="text-xs text-gray-400">{{ $category->slug }}</p>
              </div>
              <div class="mt-4 flex gap-2">
                <button
                  class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                  data-action="{{ route('dashboard.categories.update', $category) }}"
                  data-name="{{ $category->name }}"
                  data-slug="{{ $category->slug }}"
                  data-heading="{{ $category->heading }}"
                  data-sort="{{ $category->sort_order }}"
                  data-active="{{ $category->is_active ? '1' : '0' }}"
                  onclick="openCategoryEdit(this)"
                >Edit</button>
                <form id="delete-category-{{ $category->id }}" method="POST" action="{{ route('dashboard.categories.destroy', $category) }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" onclick="openConfirm('Hapus kategori', 'Hapus kategori ini?', 'delete-category-{{ $category->id }}')" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
                </form>
              </div>
            </div>
          @empty
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">Belum ada kategori.</div>
          @endforelse
        </div>
      </section>

      <section id="section-umkm" class="mt-10 hidden space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <h2 class="text-2xl font-semibold text-slate-800">UMKM</h2>
          <button onclick="openUmkmCreate()" class="bg-maroon text-white px-5 py-2 rounded-full hover-maroon transition transform hover:scale-105 duration-300">
            + Tambah
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($umkms as $umkm)
            @php
              $image = $umkm->image_path ?: 'assets/img/chefs/chefs-1.jpg';
              if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                $image = \Illuminate\Support\Facades\Storage::url($image);
              }
            @endphp
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center transition duration-300 hover:shadow-lg">
              <div class="w-full h-44 mb-4 rounded-xl overflow-hidden border border-gray-100">
                <img src="{{ $image }}" alt="{{ $umkm->name }}" class="w-full h-full object-cover">
              </div>
              <h3 class="font-semibold text-lg text-maroon">{{ $umkm->name }}</h3>
              <p class="text-sm text-gray-500">{{ $umkm->specialty }}</p>
              <p class="text-sm text-gray-600 mt-2 mb-4">{{ $umkm->description }}</p>
              <div class="flex gap-2">
                <button
                  class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                  data-action="{{ route('dashboard.umkms.update', $umkm) }}"
                  data-name="{{ $umkm->name }}"
                  data-specialty="{{ $umkm->specialty }}"
                  data-description="{{ $umkm->description }}"
                  data-sort="{{ $umkm->sort_order }}"
                  data-active="{{ $umkm->is_active ? '1' : '0' }}"
                  data-image="{{ $image }}"
                  onclick="openUmkmEdit(this)"
                >Edit</button>
                <form id="delete-umkm-{{ $umkm->id }}" method="POST" action="{{ route('dashboard.umkms.destroy', $umkm) }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" onclick="openConfirm('Hapus UMKM', 'Hapus data UMKM ini?', 'delete-umkm-{{ $umkm->id }}')" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
                </form>
              </div>
            </div>
          @empty
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">Belum ada UMKM.</div>
          @endforelse
        </div>
      </section>

      <section id="section-event" class="mt-10 hidden space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <h2 class="text-2xl font-semibold text-slate-800">Events</h2>
          <button onclick="openEventCreate()" class="bg-maroon text-white px-5 py-2 rounded-full hover-maroon transition transform hover:scale-105 duration-300">
            + Tambah
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($events as $event)
            @php
              $image = $event->image_path ?: 'assets/img/events-1.jpg';
              if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                $image = \Illuminate\Support\Facades\Storage::url($image);
              }
            @endphp
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center transition duration-300 hover:shadow-lg">
              <div class="w-full h-44 mb-4 rounded-xl overflow-hidden border border-gray-100">
                <img src="{{ $image }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
              </div>
              <h3 class="font-semibold text-lg text-maroon">{{ $event->title }}</h3>
              @if ($event->price_label)
                <p class="text-sm text-gray-500">{{ $event->price_label }}</p>
              @endif
              <p class="text-sm text-gray-600 mt-2 mb-4">{{ $event->description }}</p>
              <div class="flex gap-2">
                <button
                  class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                  data-action="{{ route('dashboard.events.update', $event) }}"
                  data-title="{{ $event->title }}"
                  data-price="{{ $event->price_label }}"
                  data-description="{{ $event->description }}"
                  data-sort="{{ $event->sort_order }}"
                  data-active="{{ $event->is_active ? '1' : '0' }}"
                  data-image="{{ $image }}"
                  onclick="openEventEdit(this)"
                >Edit</button>
                <form id="delete-event-{{ $event->id }}" method="POST" action="{{ route('dashboard.events.destroy', $event) }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" onclick="openConfirm('Hapus event', 'Hapus event ini?', 'delete-event-{{ $event->id }}')" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
                </form>
              </div>
            </div>
          @empty
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">Belum ada event.</div>
          @endforelse
        </div>
      </section>

      <section id="section-gallery" class="mt-10 hidden space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <h2 class="text-2xl font-semibold text-slate-800">Gallery</h2>
          <button onclick="openGalleryCreate()" class="bg-maroon text-white px-5 py-2 rounded-full hover-maroon transition transform hover:scale-105 duration-300">
            + Tambah
          </button>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($galleries as $gallery)
            @php
              $image = $gallery->image_path ?: 'assets/img/gallery/gallery-1.jpg';
              if (!\Illuminate\Support\Str::startsWith($image, ['assets/', 'http://', 'https://', '/'])) {
                $image = \Illuminate\Support\Facades\Storage::url($image);
              }
            @endphp
            <div class="bg-white rounded-2xl shadow-md p-4 flex flex-col items-center text-center transition duration-300 hover:shadow-lg">
              <div class="w-full h-44 mb-4 rounded-xl overflow-hidden border border-gray-100">
                <img src="{{ $image }}" alt="{{ $gallery->title ?? 'Gallery' }}" class="w-full h-full object-cover">
              </div>
              <h3 class="font-semibold text-lg text-maroon">{{ $gallery->title ?? 'Gallery' }}</h3>
              <div class="mt-3 flex gap-2">
                <button
                  class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                  data-action="{{ route('dashboard.galleries.update', $gallery) }}"
                  data-title="{{ $gallery->title }}"
                  data-sort="{{ $gallery->sort_order }}"
                  data-active="{{ $gallery->is_active ? '1' : '0' }}"
                  data-image="{{ $image }}"
                  onclick="openGalleryEdit(this)"
                >Edit</button>
                <form id="delete-gallery-{{ $gallery->id }}" method="POST" action="{{ route('dashboard.galleries.destroy', $gallery) }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" onclick="openConfirm('Hapus gallery', 'Hapus gambar ini?', 'delete-gallery-{{ $gallery->id }}')" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
                </form>
              </div>
            </div>
          @empty
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">Belum ada gallery.</div>
          @endforelse
        </div>
      </section>
    </main>
  </div>

  <div id="menuModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl transform transition-transform duration-300 scale-95">
      <h3 class="text-xl font-semibold mb-5" id="menuModalTitle">Tambah Menu</h3>
      <form id="menuForm" method="POST" action="{{ route('dashboard.items.store') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="menuMethod" value="POST">
        <select name="menu_category_id" id="menuCategory" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <input type="text" name="name" id="menuName" placeholder="Nama" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <input type="number" name="price" id="menuPrice" placeholder="Harga" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <textarea name="description" id="menuDescription" placeholder="Deskripsi" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300"></textarea>
        <input type="file" name="image" id="menuImage" class="w-full">
        <input type="number" name="sort_order" id="menuSort" placeholder="Urutan" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <label class="flex items-center gap-2 text-sm text-gray-600">
          <input type="checkbox" name="is_active" id="menuActive" value="1" class="h-4 w-4 rounded">
          Aktif
        </label>
        <div class="flex justify-end gap-3 pt-3">
          <button type="button" onclick="closeModal('menuModal')" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition duration-300">Batal</button>
          <button class="bg-maroon text-white px-5 py-2 rounded-lg hover-maroon transition transform hover:scale-105 duration-300">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div id="categoryModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl transform transition-transform duration-300 scale-95">
      <h3 class="text-xl font-semibold mb-5" id="categoryModalTitle">Tambah Kategori</h3>
      <form id="categoryForm" method="POST" action="{{ route('dashboard.categories.store') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="_method" id="categoryMethod" value="POST">
        <input type="text" name="name" id="categoryName" placeholder="Nama" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <input type="text" name="slug" id="categorySlug" placeholder="Slug" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <input type="text" name="heading" id="categoryHeading" placeholder="Heading" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <input type="number" name="sort_order" id="categorySort" placeholder="Urutan" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <label class="flex items-center gap-2 text-sm text-gray-600">
          <input type="checkbox" name="is_active" id="categoryActive" value="1" class="h-4 w-4 rounded">
          Aktif
        </label>
        <div class="flex justify-end gap-3 pt-3">
          <button type="button" onclick="closeModal('categoryModal')" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition duration-300">Batal</button>
          <button class="bg-maroon text-white px-5 py-2 rounded-lg hover-maroon transition transform hover:scale-105 duration-300">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div id="umkmModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl transform transition-transform duration-300 scale-95">
      <h3 class="text-xl font-semibold mb-5" id="umkmModalTitle">Tambah UMKM</h3>
      <form id="umkmForm" method="POST" action="{{ route('dashboard.umkms.store') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="umkmMethod" value="POST">
        <input type="text" name="name" id="umkmName" placeholder="Nama UMKM" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <input type="text" name="specialty" id="umkmSpecialty" placeholder="Bidang UMKM" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <textarea name="description" id="umkmDescription" placeholder="Deskripsi" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300"></textarea>
        <input type="file" name="image" id="umkmImage" class="w-full">
        <input type="number" name="sort_order" id="umkmSort" placeholder="Urutan" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <label class="flex items-center gap-2 text-sm text-gray-600">
          <input type="checkbox" name="is_active" id="umkmActive" value="1" class="h-4 w-4 rounded">
          Aktif
        </label>
        <div class="flex justify-end gap-3 pt-3">
          <button type="button" onclick="closeModal('umkmModal')" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition duration-300">Batal</button>
          <button class="bg-maroon text-white px-5 py-2 rounded-lg hover-maroon transition transform hover:scale-105 duration-300">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div id="eventModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl transform transition-transform duration-300 scale-95">
      <h3 class="text-xl font-semibold mb-5" id="eventModalTitle">Tambah Event</h3>
      <form id="eventForm" method="POST" action="{{ route('dashboard.events.store') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="eventMethod" value="POST">
        <input type="text" name="title" id="eventTitle" placeholder="Judul Event" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300" required>
        <input type="text" name="price_label" id="eventPrice" placeholder="Harga" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <textarea name="description" id="eventDescription" placeholder="Deskripsi" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300"></textarea>
        <input type="file" name="image" id="eventImage" class="w-full">
        <input type="number" name="sort_order" id="eventSort" placeholder="Urutan" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <label class="flex items-center gap-2 text-sm text-gray-600">
          <input type="checkbox" name="is_active" id="eventActive" value="1" class="h-4 w-4 rounded">
          Aktif
        </label>
        <div class="flex justify-end gap-3 pt-3">
          <button type="button" onclick="closeModal('eventModal')" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition duration-300">Batal</button>
          <button class="bg-maroon text-white px-5 py-2 rounded-lg hover-maroon transition transform hover:scale-105 duration-300">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div id="galleryModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 transition-opacity">
    <div class="bg-white w-full max-w-lg rounded-2xl p-6 shadow-2xl transform transition-transform duration-300 scale-95">
      <h3 class="text-xl font-semibold mb-5" id="galleryModalTitle">Tambah Gallery</h3>
      <form id="galleryForm" method="POST" action="{{ route('dashboard.galleries.store') }}" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="galleryMethod" value="POST">
        <input type="text" name="title" id="galleryTitle" placeholder="Judul (opsional)" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <input type="file" name="image" id="galleryImage" class="w-full" required>
        <input type="number" name="sort_order" id="gallerySort" placeholder="Urutan" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-maroon transition duration-300">
        <label class="flex items-center gap-2 text-sm text-gray-600">
          <input type="checkbox" name="is_active" id="galleryActive" value="1" class="h-4 w-4 rounded">
          Aktif
        </label>
        <div class="flex justify-end gap-3 pt-3">
          <button type="button" onclick="closeModal('galleryModal')" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition duration-300">Batal</button>
          <button class="bg-maroon text-white px-5 py-2 rounded-lg hover-maroon transition transform hover:scale-105 duration-300">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div id="confirmModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 text-center transform transition-all scale-90">
      <div class="mx-auto mb-4 w-12 h-12 flex items-center justify-center rounded-full bg-red-100 text-red-600 text-2xl">
        !
      </div>
      <h3 id="confirmTitle" class="text-xl font-semibold mb-2">Konfirmasi</h3>
      <p id="confirmMessage" class="text-gray-600 mb-6">Apakah kamu yakin?</p>
      <div class="flex justify-center gap-4">
        <button onclick="closeConfirmModal()" class="px-5 py-2 rounded-lg border hover:bg-gray-100 transition">Batal</button>
        <button id="confirmActionBtn" class="px-5 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition transform hover:scale-105">Ya, Lanjutkan</button>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  function showSection(type) {
    ['menu', 'kategori', 'umkm', 'event', 'gallery'].forEach(section => {
      const target = document.getElementById('section-' + section);
      if (target) {
        target.classList.toggle('hidden', section !== type);
      }
    });

    const navButtons = {
      menu: document.getElementById('nav-menu'),
      kategori: document.getElementById('nav-kategori'),
      umkm: document.getElementById('nav-umkm'),
      event: document.getElementById('nav-event'),
      gallery: document.getElementById('nav-gallery'),
    };

    Object.entries(navButtons).forEach(([key, button]) => {
      if (!button) {
        return;
      }

      const isActive = key === type;
      button.classList.toggle('bg-maroon', isActive);
      button.classList.toggle('text-white', isActive);
      button.classList.toggle('text-slate-700', !isActive);
    });
  }

  function openMenuCreate() {
    const form = document.getElementById('menuForm');
    form.reset();
    form.action = "{{ route('dashboard.items.store') }}";
    document.getElementById('menuMethod').value = 'POST';
    document.getElementById('menuModalTitle').innerText = 'Tambah Menu';
    document.getElementById('menuActive').checked = false;
    document.getElementById('menuModal').classList.remove('hidden');
  }

  function openMenuEdit(button) {
    const form = document.getElementById('menuForm');
    form.reset();
    form.action = button.getAttribute('data-action');
    document.getElementById('menuMethod').value = 'PUT';
    document.getElementById('menuModalTitle').innerText = 'Edit Menu';
    document.getElementById('menuCategory').value = button.getAttribute('data-category');
    document.getElementById('menuName').value = button.getAttribute('data-name');
    document.getElementById('menuPrice').value = button.getAttribute('data-price');
    document.getElementById('menuDescription').value = button.getAttribute('data-description');
    document.getElementById('menuSort').value = button.getAttribute('data-sort');
    document.getElementById('menuActive').checked = button.getAttribute('data-active') === '1';
    document.getElementById('menuModal').classList.remove('hidden');
  }

  function openCategoryCreate() {
    const form = document.getElementById('categoryForm');
    form.reset();
    form.action = "{{ route('dashboard.categories.store') }}";
    document.getElementById('categoryMethod').value = 'POST';
    document.getElementById('categoryModalTitle').innerText = 'Tambah Kategori';
    document.getElementById('categoryActive').checked = false;
    document.getElementById('categoryModal').classList.remove('hidden');
  }

  function openCategoryEdit(button) {
    const form = document.getElementById('categoryForm');
    form.reset();
    form.action = button.getAttribute('data-action');
    document.getElementById('categoryMethod').value = 'PUT';
    document.getElementById('categoryModalTitle').innerText = 'Edit Kategori';
    document.getElementById('categoryName').value = button.getAttribute('data-name');
    document.getElementById('categorySlug').value = button.getAttribute('data-slug');
    document.getElementById('categoryHeading').value = button.getAttribute('data-heading');
    document.getElementById('categorySort').value = button.getAttribute('data-sort');
    document.getElementById('categoryActive').checked = button.getAttribute('data-active') === '1';
    document.getElementById('categoryModal').classList.remove('hidden');
  }

  function openUmkmCreate() {
    const form = document.getElementById('umkmForm');
    form.reset();
    form.action = "{{ route('dashboard.umkms.store') }}";
    document.getElementById('umkmMethod').value = 'POST';
    document.getElementById('umkmModalTitle').innerText = 'Tambah UMKM';
    document.getElementById('umkmActive').checked = false;
    document.getElementById('umkmModal').classList.remove('hidden');
  }

  function openUmkmEdit(button) {
    const form = document.getElementById('umkmForm');
    form.reset();
    form.action = button.getAttribute('data-action');
    document.getElementById('umkmMethod').value = 'PUT';
    document.getElementById('umkmModalTitle').innerText = 'Edit UMKM';
    document.getElementById('umkmName').value = button.getAttribute('data-name');
    document.getElementById('umkmSpecialty').value = button.getAttribute('data-specialty');
    document.getElementById('umkmDescription').value = button.getAttribute('data-description');
    document.getElementById('umkmSort').value = button.getAttribute('data-sort');
    document.getElementById('umkmActive').checked = button.getAttribute('data-active') === '1';
    document.getElementById('umkmModal').classList.remove('hidden');
  }

  function openEventCreate() {
    const form = document.getElementById('eventForm');
    form.reset();
    form.action = "{{ route('dashboard.events.store') }}";
    document.getElementById('eventMethod').value = 'POST';
    document.getElementById('eventModalTitle').innerText = 'Tambah Event';
    document.getElementById('eventActive').checked = false;
    document.getElementById('eventModal').classList.remove('hidden');
  }

  function openEventEdit(button) {
    const form = document.getElementById('eventForm');
    form.reset();
    form.action = button.getAttribute('data-action');
    document.getElementById('eventMethod').value = 'PUT';
    document.getElementById('eventModalTitle').innerText = 'Edit Event';
    document.getElementById('eventTitle').value = button.getAttribute('data-title');
    document.getElementById('eventPrice').value = button.getAttribute('data-price');
    document.getElementById('eventDescription').value = button.getAttribute('data-description');
    document.getElementById('eventSort').value = button.getAttribute('data-sort');
    document.getElementById('eventActive').checked = button.getAttribute('data-active') === '1';
    document.getElementById('eventModal').classList.remove('hidden');
  }

  function openGalleryCreate() {
    const form = document.getElementById('galleryForm');
    form.reset();
    form.action = "{{ route('dashboard.galleries.store') }}";
    document.getElementById('galleryMethod').value = 'POST';
    document.getElementById('galleryModalTitle').innerText = 'Tambah Gallery';
    document.getElementById('galleryActive').checked = false;
    document.getElementById('galleryImage').required = true;
    document.getElementById('galleryModal').classList.remove('hidden');
  }

  function openGalleryEdit(button) {
    const form = document.getElementById('galleryForm');
    form.reset();
    form.action = button.getAttribute('data-action');
    document.getElementById('galleryMethod').value = 'PUT';
    document.getElementById('galleryModalTitle').innerText = 'Edit Gallery';
    document.getElementById('galleryTitle').value = button.getAttribute('data-title');
    document.getElementById('gallerySort').value = button.getAttribute('data-sort');
    document.getElementById('galleryActive').checked = button.getAttribute('data-active') === '1';
    document.getElementById('galleryImage').required = false;
    document.getElementById('galleryModal').classList.remove('hidden');
  }

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
  }

  let confirmFormId = null;
  function openConfirm(title, message, formId) {
    confirmFormId = formId;
    document.getElementById('confirmTitle').innerText = title;
    document.getElementById('confirmMessage').innerText = message;
    document.getElementById('confirmModal').classList.remove('hidden');
  }

  function closeConfirmModal() {
    confirmFormId = null;
    document.getElementById('confirmModal').classList.add('hidden');
  }

  document.getElementById('confirmActionBtn').addEventListener('click', () => {
    if (confirmFormId) {
      const form = document.getElementById(confirmFormId);
      if (form) {
        form.submit();
      }
    }
    closeConfirmModal();
  });

  showSection('menu');
</script>
@endpush
