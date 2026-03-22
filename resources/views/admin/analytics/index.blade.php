@extends('layouts.admin')

@section('title', 'Analytics Link Bio')
@section('page_title', 'Analytics')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Total Visit</div>
                    <div class="metric-value">{{ $summary['total_visits'] }}</div>
                    <div class="metric-meta">Semua kunjungan landing page.</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Visitor Unik</div>
                    <div class="metric-value">{{ $summary['unique_visitors'] }}</div>
                    <div class="metric-meta">Dihitung dari session id.</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Total Klik</div>
                    <div class="metric-value">{{ $summary['total_clicks'] }}</div>
                    <div class="metric-meta">Semua klik link yang masuk.</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card metric-card h-100">
                <div class="card-body">
                    <div class="metric-label">Link Aktif</div>
                    <div class="metric-value">{{ $summary['active_links'] }}</div>
                    <div class="metric-meta">Jumlah link yang tampil saat ini.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card content-card mb-4">
        <div class="card-header">
            <div class="section-title">Ringkasan klik per link</div>
            <div class="section-note">Mempermudah melihat tombol mana yang paling efektif.</div>
        </div>

        <div class="table-responsive desktop-only">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Judul Link</th>
                        <th>Kategori</th>
                        <th>Total Klik</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clickSummary as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->title }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->clicks_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data analytics.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mobile-only p-3 d-flex flex-column gap-3">
            @forelse($clickSummary as $item)
                <div class="mobile-list-card">
                    <div class="d-flex justify-content-between gap-3 align-items-start">
                        <div>
                            <div class="fw-semibold">{{ $item->title }}</div>
                            <div class="section-note">{{ $item->category }}</div>
                        </div>
                        <span class="soft-badge"><i class='bx bx-mouse'></i> {{ $item->clicks_count }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-4">Belum ada data analytics.</div>
            @endforelse
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card content-card h-100">
                <div class="card-header">
                    <div class="section-title">Histori visit landing page</div>
                    <div class="section-note">Log kunjungan yang terekam dari halaman utama.</div>
                </div>

                <div class="table-responsive desktop-only">
                    <table class="table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Session</th>
                                <th>IP</th>
                                <th>Referer</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVisits as $visit)
                                <tr>
                                    <td>{{ \Illuminate\Support\Str::limit($visit->session_id, 16) }}</td>
                                    <td>{{ $visit->ip_address ?? '-' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($visit->referer, 28) ?: '-' }}</td>
                                    <td>{{ $visit->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada visit.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mobile-only p-3 d-flex flex-column gap-3">
                    @forelse($recentVisits as $visit)
                        <div class="mobile-list-card">
                            <div class="mobile-row">
                                <div class="label">Session</div>
                                <div>{{ \Illuminate\Support\Str::limit($visit->session_id, 18) }}</div>
                            </div>
                            <div class="mobile-row">
                                <div class="label">IP</div>
                                <div>{{ $visit->ip_address ?? '-' }}</div>
                            </div>
                            <div class="mobile-row">
                                <div class="label">Referer</div>
                                <div>{{ \Illuminate\Support\Str::limit($visit->referer, 36) ?: '-' }}</div>
                            </div>
                            <div class="mobile-row">
                                <div class="label">Waktu</div>
                                <div>{{ $visit->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">Belum ada visit.</div>
                    @endforelse
                </div>

                <div class="card-body pt-2">
                    {{ $recentVisits->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card content-card h-100">
                <div class="card-header">
                    <div class="section-title">Histori klik link</div>
                    <div class="section-note">Log klik berdasarkan tombol yang dibuka pengunjung.</div>
                </div>

                <div class="table-responsive desktop-only">
                    <table class="table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Link</th>
                                <th>Session</th>
                                <th>IP</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentClicks as $click)
                                <tr>
                                    <td>{{ $click->bioLink->title ?? '-' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($click->session_id, 16) }}</td>
                                    <td>{{ $click->ip_address ?? '-' }}</td>
                                    <td>{{ $click->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada klik.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mobile-only p-3 d-flex flex-column gap-3">
                    @forelse($recentClicks as $click)
                        <div class="mobile-list-card">
                            <div class="mobile-row">
                                <div class="label">Link</div>
                                <div>{{ $click->bioLink->title ?? '-' }}</div>
                            </div>
                            <div class="mobile-row">
                                <div class="label">Session</div>
                                <div>{{ \Illuminate\Support\Str::limit($click->session_id, 18) }}</div>
                            </div>
                            <div class="mobile-row">
                                <div class="label">IP</div>
                                <div>{{ $click->ip_address ?? '-' }}</div>
                            </div>
                            <div class="mobile-row">
                                <div class="label">Waktu</div>
                                <div>{{ $click->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">Belum ada klik.</div>
                    @endforelse
                </div>

                <div class="card-body pt-2">
                    {{ $recentClicks->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
