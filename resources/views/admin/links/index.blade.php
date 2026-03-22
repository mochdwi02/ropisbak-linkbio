@extends('layouts.admin')

@section('title', 'Kelola Link')
@section('page_title', 'Kelola Link')

@section('content')
    <div class="card search-card content-card mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-3">
                <div>
                    <div class="section-title">Filter & pencarian</div>
                    <div class="section-note">Cari berdasarkan judul, kategori, atau URL untuk mempercepat pengelolaan link.</div>
                </div>
                <a href="{{ route('admin.links.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Link
                </a>
            </div>

            <form method="GET" class="row g-3 align-items-end">
                <div class="col-lg-5">
                    <label class="form-label">Cari Link</label>
                    <input type="text" name="q" class="form-control" value="{{ $q }}" placeholder="Judul, kategori, atau URL">
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $item)
                            <option value="{{ $item }}" {{ $category === $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 d-flex gap-2">
                    <button class="btn btn-outline-primary w-100">Filter</button>
                    <a href="{{ route('admin.links.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Total Data</div>
                    <div class="metric-value">{{ $links->total() }}</div>
                    <div class="metric-meta">Jumlah hasil sesuai filter.</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Kategori</div>
                    <div class="metric-value">{{ $categories->count() }}</div>
                    <div class="metric-meta">Kategori link yang sudah dipakai.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card content-card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="section-title">Daftar link</div>
                <div class="section-note">Tampilan desktop berupa tabel, sedangkan di HP otomatis berubah jadi kartu agar lebih nyaman.</div>
            </div>
        </div>

        <div class="table-responsive desktop-only">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Total Klik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($links as $link)
                        <tr>
                            <td>{{ $link->sort_order }}</td>
                            <td>
                                <div class="fw-semibold">{{ $link->title }}</div>
                            </td>
                            <td>{{ $link->category }}</td>
                            <td>
                                <a href="{{ $link->url }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 240px;">
                                    {{ $link->url }}
                                </a>
                            </td>
                            <td><i class="{{ $link->icon }} me-1"></i> {{ $link->icon }}</td>
                            <td>
                                @if($link->is_active)
                                    <span class="badge bg-label-success">Aktif</span>
                                @else
                                    <span class="badge bg-label-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $link->clicks_count }}</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.links.edit', $link) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.links.destroy', $link) }}" method="POST" onsubmit="return confirm('Hapus link ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">Belum ada link.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mobile-only p-3 d-flex flex-column gap-3">
            @forelse($links as $link)
                <div class="mobile-list-card">
                    <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="rank-pill"><i class="{{ $link->icon ?: 'bx bx-link-alt' }}"></i></span>
                            <div>
                                <div class="fw-semibold">{{ $link->title }}</div>
                                <div class="section-note">{{ $link->category }}</div>
                            </div>
                        </div>
                        @if($link->is_active)
                            <span class="badge bg-label-success">Aktif</span>
                        @else
                            <span class="badge bg-label-secondary">Nonaktif</span>
                        @endif
                    </div>

                    <div class="mobile-row">
                        <div class="label">Urutan</div>
                        <div>{{ $link->sort_order }}</div>
                    </div>
                    <div class="mobile-row">
                        <div class="label">URL</div>
                        <div><a href="{{ $link->url }}" target="_blank">{{ \Illuminate\Support\Str::limit($link->url, 42) }}</a></div>
                    </div>
                    <div class="mobile-row">
                        <div class="label">Klik</div>
                        <div>{{ $link->clicks_count }}</div>
                    </div>
                    <div class="mobile-row">
                        <div class="label">Icon</div>
                        <div>{{ $link->icon }}</div>
                    </div>

                    <div class="table-actions mt-3">
                        <a href="{{ route('admin.links.edit', $link) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.links.destroy', $link) }}" method="POST" onsubmit="return confirm('Hapus link ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-4">Belum ada link.</div>
            @endforelse
        </div>

        <div class="card-body pt-2">
            {{ $links->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
