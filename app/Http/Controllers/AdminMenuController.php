<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuCategoryRequest;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuCategoryRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
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

        return response()->view('admin.dashboard', [
            'categories' => $categories,
            'items' => $items,
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
}
