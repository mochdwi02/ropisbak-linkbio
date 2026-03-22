@extends('layouts.admin')

@section('title', 'Dashboard Admin Link Bio')
@section('page_title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card highlight-card content-card">
                <div class="card-body p-4">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-7">
                            <span class="soft-badge mb-3"><i class='bx bx-pulse'></i> Ringkasan performa link bio</span>
                            <h4 class="mb-2">Panel admin yang lebih rapi, ringan, dan enak dipakai dari desktop maupun HP.</h4>
                            <p class="mb-0 section-note">Pantau jumlah link aktif, klik harian, traffic landing page, dan performa tiap tombol tanpa perlu buka phpMyAdmin terus-menerus.</p>
                        </div>
                        <div class="col-lg-5">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="metric-card card h-100">
                                        <div class="card-body">
                                            <div class="metric-label">Conversion Rate</div>
                                            <div class="metric-value">{{ number_format($stats['conversion_rate'], 1) }}%</div>
                                            <div class="metric-meta">Perbandingan klik terhadap visit.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="metric-card card h-100">
                                        <div class="card-body">
                                            <div class="metric-label">Klik Hari Ini</div>
                                            <div class="metric-value">{{ $stats['today_clicks'] }}</div>
                                            <div class="metric-meta">Aktivitas tombol pada hari ini.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $metrics = [
                ['label' => 'Total Link', 'value' => $stats['total_links'], 'meta' => 'Semua tombol yang tersimpan'],
                ['label' => 'Link Aktif', 'value' => $stats['active_links'], 'meta' => 'Link yang tampil di landing page'],
                ['label' => 'Total Visit', 'value' => $stats['total_visits'], 'meta' => 'Kunjungan landing page'],
                ['label' => 'Visitor Unik', 'value' => $stats['unique_visitors'], 'meta' => 'Per sesi yang tercatat'],
                ['label' => 'Total Klik', 'value' => $stats['total_clicks'], 'meta' => 'Semua klik tombol'],
                ['label' => 'Klik Hari Ini', 'value' => $stats['today_clicks'], 'meta' => 'Klik pada tanggal hari ini'],
            ];
        @endphp

        @foreach($metrics as $metric)
            <div class="col-sm-6 col-xl-4">
                <div class="card metric-card h-100">
                    <div class="card-body">
                        <div class="metric-label">{{ $metric['label'] }}</div>
                        <div class="metric-value">{{ $metric['value'] }}</div>
                        <div class="metric-meta">{{ $metric['meta'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card content-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <div class="section-title">Trend klik 7 hari terakhir</div>
                        <div class="section-note">Melihat pergerakan traffic link secara singkat.</div>
                    </div>
                    <span class="soft-badge"><i class='bx bx-line-chart'></i> 7 hari</span>
                </div>
                <div class="card-body">
                    <div id="dailyClicksChart" style="min-height: 280px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card content-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <div class="section-title">Top link</div>
                        <div class="section-note">Tombol yang paling sering dibuka pengunjung.</div>
                    </div>
                    <a href="{{ route('admin.links.index') }}" class="btn btn-sm btn-outline-primary">Kelola</a>
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    @forelse($topLinks->take(5) as $index => $link)
                        @php
                            $maxClicks = max(1, (int) optional($topLinks->first())->clicks_count);
                            $percent = round(($link->clicks_count / $maxClicks) * 100);
                        @endphp
                        <div class="d-flex gap-3 align-items-start">
                            <div class="rank-pill">{{ $index + 1 }}</div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between gap-3 mb-1">
                                    <div>
                                        <div class="fw-semibold">{{ $link->title }}</div>
                                        <div class="section-note">{{ $link->category }}</div>
                                    </div>
                                    <div class="fw-semibold text-nowrap">{{ $link->clicks_count }} klik</div>
                                </div>
                                <div class="progress progress-thin">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">Belum ada data klik.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card content-card h-100">
                <div class="card-header">
                    <div class="section-title">Klik terbaru</div>
                    <div class="section-note">Aktivitas terakhir yang masuk ke sistem.</div>
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    @forelse($recentClicks as $click)
                        <div class="mobile-list-card p-3">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="fw-semibold">{{ $click->bioLink->title ?? '-' }}</div>
                                    <div class="section-note">{{ $click->ip_address ?? 'IP tidak tersedia' }}</div>
                                </div>
                                <span class="soft-badge"><i class='bx bx-time'></i> {{ $click->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">Belum ada klik terbaru.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card content-card h-100">
                <div class="card-header">
                    <div class="section-title">Ringkasan harian</div>
                    <div class="section-note">Total klik yang tercatat per tanggal.</div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive desktop-only">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Klik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dailyClicks as $row)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($row->click_date)->format('d/m/Y') }}</td>
                                        <td>{{ $row->total_clicks }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">Belum ada histori klik 7 hari terakhir.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mobile-only p-3 d-flex flex-column gap-3">
                        @forelse($dailyClicks as $row)
                            <div class="mobile-list-card">
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div>
                                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($row->click_date)->format('d/m/Y') }}</div>
                                        <div class="section-note">Aktivitas klik harian</div>
                                    </div>
                                    <span class="soft-badge"><i class='bx bx-mouse'></i> {{ $row->total_clicks }} klik</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">Belum ada histori klik.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartEl = document.querySelector('#dailyClicksChart');
            if (!chartEl || typeof ApexCharts === 'undefined') return;

            const options = {
                chart: {
                    type: 'area',
                    height: 280,
                    toolbar: { show: false },
                    sparkline: { enabled: false }
                },
                series: [{
                    name: 'Klik',
                    data: @json($chartSeries)
                }],
                xaxis: {
                    categories: @json($chartLabels),
                    labels: { rotate: 0 }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.28,
                        opacityTo: 0.06,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: { enabled: false },
                grid: {
                    borderColor: 'rgba(141,107,77,.12)',
                    strokeDashArray: 4,
                    padding: { left: 12, right: 12 }
                },
                colors: ['#8d6b4d'],
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + ' klik';
                        }
                    }
                }
            };

            new ApexCharts(chartEl, options).render();
        });
    </script>
@endpush
