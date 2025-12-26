<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\StoreMenuCategoryRequest;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Requests\UpdateMenuCategoryRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Testimonial;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminMenuController extends Controller
{
    public function dataItems(): Response
    {
        $items = MenuItem::query()
            ->with('category')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $categories = MenuCategory::query()
            ->orderBy('sort_order')
            ->get();

        $umkms = Umkm::query()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $events = Event::query()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $galleries = Gallery::query()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $testimonials = Testimonial::query()
            ->with('user')
            ->latest()
            ->get();

        return response()->view('admin.dashboard', [
            'categories' => $categories,
            'items' => $items,
            'umkms' => $umkms,
            'events' => $events,
            'galleries' => $galleries,
            'testimonials' => $testimonials,
        ]);
    }

    public function dataCategories(): Response
    {
        $categories = MenuCategory::query()
            ->orderBy('sort_order')
            ->get();

        return response()->view('admin.menu.categories-data', [
            'categories' => $categories,
        ]);
    }

    public function categories(): Response
    {
        return response()->view('admin.menu.categories');
    }

    public function items(): Response
    {
        $categories = MenuCategory::query()
            ->orderBy('sort_order')
            ->get();

        $items = MenuItem::query()
            ->with('category')
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return response()->view('admin.menu.items', [
            'categories' => $categories,
        ]);
    }

    public function storeCategory(StoreMenuCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        MenuCategory::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'heading' => $validated['heading'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Kategori menu berhasil ditambahkan.');
    }

    public function updateCategory(UpdateMenuCategoryRequest $request, MenuCategory $category): RedirectResponse
    {
        $validated = $request->validated();

        $category->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'heading' => $validated['heading'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Kategori menu berhasil diperbarui.');
    }

    public function destroyCategory(MenuCategory $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->back()
            ->with('status', 'Kategori menu berhasil dihapus.');
    }

    public function storeItem(StoreMenuItemRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu', 'public');
        }

        MenuItem::create([
            'menu_category_id' => $validated['menu_category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Menu berhasil ditambahkan.');
    }

    public function updateItem(UpdateMenuItemRequest $request, MenuItem $item): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $item->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath && ! Str::startsWith($imagePath, ['assets/', 'http://', 'https://', '/'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('menu', 'public');
        }

        $item->update([
            'menu_category_id' => $validated['menu_category_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Menu berhasil diperbarui.');
    }

    public function destroyItem(MenuItem $item): RedirectResponse
    {
        if ($item->image_path && ! Str::startsWith($item->image_path, ['assets/', 'http://', 'https://', '/'])) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        return redirect()
            ->back()
            ->with('status', 'Menu berhasil dihapus.');
    }

    public function storeUmkm(StoreUmkmRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('umkms', 'public');
        }

        Umkm::create([
            'name' => $validated['name'],
            'specialty' => $validated['specialty'],
            'description' => $validated['description'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'UMKM berhasil ditambahkan.');
    }

    public function updateUmkm(UpdateUmkmRequest $request, Umkm $umkm): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $umkm->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath && ! Str::startsWith($imagePath, ['assets/', 'http://', 'https://', '/'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('umkms', 'public');
        }

        $umkm->update([
            'name' => $validated['name'],
            'specialty' => $validated['specialty'],
            'description' => $validated['description'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'UMKM berhasil diperbarui.');
    }

    public function destroyUmkm(Umkm $umkm): RedirectResponse
    {
        if ($umkm->image_path && ! Str::startsWith($umkm->image_path, ['assets/', 'http://', 'https://', '/'])) {
            Storage::disk('public')->delete($umkm->image_path);
        }

        $umkm->delete();

        return redirect()
            ->back()
            ->with('status', 'UMKM berhasil dihapus.');
    }

    public function storeEvent(StoreEventRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'title' => $validated['title'],
            'price_label' => $validated['price_label'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Event berhasil ditambahkan.');
    }

    public function updateEvent(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $event->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath && ! Str::startsWith($imagePath, ['assets/', 'http://', 'https://', '/'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $validated['title'],
            'price_label' => $validated['price_label'] ?? null,
            'description' => $validated['description'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Event berhasil diperbarui.');
    }

    public function destroyEvent(Event $event): RedirectResponse
    {
        if ($event->image_path && ! Str::startsWith($event->image_path, ['assets/', 'http://', 'https://', '/'])) {
            Storage::disk('public')->delete($event->image_path);
        }

        $event->delete();

        return redirect()
            ->back()
            ->with('status', 'Event berhasil dihapus.');
    }

    public function storeGallery(StoreGalleryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $validated['title'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Gallery berhasil ditambahkan.');
    }

    public function updateGallery(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validated();

        $imagePath = $gallery->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath && ! Str::startsWith($imagePath, ['assets/', 'http://', 'https://', '/'])) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update([
            'title' => $validated['title'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Gallery berhasil diperbarui.');
    }

    public function destroyGallery(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image_path && ! Str::startsWith($gallery->image_path, ['assets/', 'http://', 'https://', '/'])) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()
            ->back()
            ->with('status', 'Gallery berhasil dihapus.');
    }

    public function destroyTestimonial(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->photo_path && ! Str::startsWith($testimonial->photo_path, ['assets/', 'http://', 'https://', '/'])) {
            Storage::disk('public')->delete($testimonial->photo_path);
        }

        $testimonial->delete();

        return redirect()
            ->back()
            ->with('status', 'Testimoni berhasil dihapus.');
    }
}
