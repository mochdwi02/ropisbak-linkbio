<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BioLink;
use Illuminate\Http\Request;

class BioLinkController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q'));
        $category = trim((string) $request->get('category'));

        $links = BioLink::query()
            ->withCount('clicks')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('title', 'like', "%{$q}%")
                        ->orWhere('url', 'like', "%{$q}%")
                        ->orWhere('category', 'like', "%{$q}%");
                });
            })
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $categories = BioLink::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.links.index', compact('links', 'categories', 'q', 'category'));
    }

    public function create()
    {
        $categories = BioLink::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.links.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'category' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['icon'] = $validated['icon'] ?: 'bx bx-link-alt';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        BioLink::create($validated);

        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Link berhasil ditambahkan.');
    }

    public function edit(BioLink $link)
    {
        $categories = BioLink::query()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.links.edit', compact('link', 'categories'));
    }

    public function update(Request $request, BioLink $link)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'category' => ['required', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['icon'] = $validated['icon'] ?: 'bx bx-link-alt';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        $link->update($validated);

        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Link berhasil diperbarui.');
    }

    public function destroy(BioLink $link)
    {
        $link->delete();

        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Link berhasil dihapus.');
    }
}
