@php
    $iconValue = old('icon', $link->icon ?? 'bx bx-link-alt');
@endphp

<div class="row g-3">
    <div class="col-12">
        <div class="mobile-list-card d-flex align-items-start gap-3 mb-1">
            <div class="rank-pill" style="width: 42px; height: 42px; font-size: 1.05rem;">
                <i class="{{ $iconValue ?: 'bx bx-link-alt' }}"></i>
            </div>
            <div>
                <div class="fw-semibold">Tips pengisian</div>
                <div class="section-note">Gunakan judul singkat, URL lengkap dengan https://, dan kategori yang konsisten agar tampilan landing page lebih rapi.</div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label class="form-label">Judul Link</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $link->title ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">URL</label>
        <input type="url" name="url" class="form-control"
               value="{{ old('url', $link->url ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kategori</label>
        <input list="category-list" name="category" class="form-control"
               value="{{ old('category', $link->category ?? '') }}" required>
        <datalist id="category-list">
            @foreach($categories as $category)
                <option value="{{ $category }}"></option>
            @endforeach
        </datalist>
    </div>

    <div class="col-md-4">
        <label class="form-label">Icon Class</label>
        <input type="text" name="icon" class="form-control"
               placeholder="bx bxl-instagram"
               value="{{ $iconValue }}">
        <small class="text-muted">Contoh: bx bxl-whatsapp, bx bx-map, bx bx-food-menu</small>
    </div>

    <div class="col-md-4">
        <label class="form-label">Urutan</label>
        <input type="number" name="sort_order" class="form-control"
               value="{{ old('sort_order', $link->sort_order ?? 0) }}" min="0">
    </div>

    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                {{ old('is_active', $link->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktifkan link</label>
        </div>
    </div>

    <div class="col-12 pt-2">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.links.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>
