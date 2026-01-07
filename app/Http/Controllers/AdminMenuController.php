<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\StoreMenuCategoryRequest;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\StoreSiteStatRequest;
use App\Http\Requests\StoreUmkmRequest;
use App\Http\Requests\StoreWhyItemRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Requests\UpdateMenuCategoryRequest;
use App\Http\Requests\UpdateMenuFavoriteRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Requests\UpdateSiteStatRequest;
use App\Http\Requests\UpdateUmkmRequest;
use App\Http\Requests\UpdateWhyItemRequest;
use App\Http\Requests\UpdateWhySectionRequest;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\MenuCategory;
use App\Models\MenuFavorite;
use App\Models\MenuItem;
use App\Models\SiteStat;
use App\Models\Testimonial;
use App\Models\Umkm;
use App\Models\WhyItem;
use App\Models\WhySection;
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

        $favoriteItemIds = MenuFavorite::query()
            ->pluck('menu_item_id')
            ->all();

        return response()->view('admin.dashboard', [
            'categories' => $categories,
            'items' => $items,
            'umkms' => $umkms,
            'events' => $events,
            'galleries' => $galleries,
            'testimonials' => $testimonials,
            'favoriteItemIds' => $favoriteItemIds,
            'stats' => SiteStat::query()
                ->orderBy('sort_order')
                ->get(),
            'whySection' => WhySection::query()->latest()->first(),
            'whyItems' => WhyItem::query()
                ->orderBy('sort_order')
                ->get(),
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

    public function updateFavorites(UpdateMenuFavoriteRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $selectedIds = $validated['menu_item_ids'] ?? [];

        if (count($selectedIds) === 0) {
            MenuFavorite::query()->delete();
        } else {
            MenuFavorite::query()
                ->whereNotIn('menu_item_id', $selectedIds)
                ->delete();
        }

        $existingIds = MenuFavorite::query()
            ->pluck('menu_item_id')
            ->all();

        $newIds = array_diff($selectedIds, $existingIds);
        $rows = array_map(static function (int $menuItemId): array {
            return [
                'menu_item_id' => $menuItemId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $newIds);

        if ($rows !== []) {
            MenuFavorite::query()->insert($rows);
        }

        return redirect()
            ->back()
            ->with('status', 'Menu favorit berhasil diperbarui.');
    }

    public function storeStat(StoreSiteStatRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        SiteStat::create([
            'key' => Str::slug($validated['label']),
            'label' => $validated['label'],
            'value' => $validated['value'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->back()
            ->with('status', 'Statistik berhasil ditambahkan.');
    }

    public function updateStats(UpdateSiteStatRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($validated['stats'] as $statData) {
            SiteStat::query()
                ->whereKey($statData['id'])
                ->update([
                    'label' => $statData['label'],
                    'value' => $statData['value'],
                    'sort_order' => $statData['sort_order'] ?? 0,
                ]);
        }

        return redirect()
            ->back()
            ->with('status', 'Statistik berhasil diperbarui.');
    }

    public function destroyStat(SiteStat $stat): RedirectResponse
    {
        $stat->delete();

        return redirect()
            ->back()
            ->with('status', 'Statistik berhasil dihapus.');
    }

    public function updateWhySection(UpdateWhySectionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        WhySection::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'button_label' => $validated['button_label'] ?? null,
                'button_link' => $validated['button_link'] ?? null,
                'is_active' => $request->boolean('is_active'),
            ]
        );

        return redirect()
            ->back()
            ->with('status', 'Why Cita Rasa Samawa berhasil diperbarui.');
    }

    public function storeWhyItem(StoreWhyItemRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        WhyItem::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'icon_class' => $validated['icon_class'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Item Why berhasil ditambahkan.');
    }

    public function updateWhyItems(UpdateWhyItemRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($validated['items'] as $item) {
            WhyItem::query()
                ->whereKey($item['id'])
                ->update([
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'icon_class' => $item['icon_class'],
                    'sort_order' => $item['sort_order'] ?? 0,
                    'is_active' => (bool) ($item['is_active'] ?? false),
                ]);
        }

        return redirect()
            ->back()
            ->with('status', 'Item Why berhasil diperbarui.');
    }

    public function destroyWhyItem(WhyItem $whyItem): RedirectResponse
    {
        $whyItem->delete();

        return redirect()
            ->back()
            ->with('status', 'Item Why berhasil dihapus.');
    }
}
