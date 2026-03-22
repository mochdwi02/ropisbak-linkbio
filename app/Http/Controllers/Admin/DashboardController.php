<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BioLink;
use App\Models\LinkClick;
use App\Models\PageVisit;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVisits = PageVisit::count();
        $totalClicks = LinkClick::count();

        $stats = [
            'total_links' => BioLink::count(),
            'active_links' => BioLink::where('is_active', true)->count(),
            'total_visits' => $totalVisits,
            'unique_visitors' => PageVisit::query()
                ->whereNotNull('session_id')
                ->distinct('session_id')
                ->count('session_id'),
            'total_clicks' => $totalClicks,
            'today_clicks' => LinkClick::whereDate('created_at', today())->count(),
            'conversion_rate' => $totalVisits > 0 ? round(($totalClicks / $totalVisits) * 100, 1) : 0,
        ];

        $topLinks = BioLink::withCount('clicks')
            ->orderByDesc('clicks_count')
            ->orderBy('title')
            ->limit(10)
            ->get();

        $recentClicks = LinkClick::with('bioLink')
            ->latest()
            ->limit(10)
            ->get();

        $dailyClicks = LinkClick::query()
            ->selectRaw('DATE(created_at) as click_date, COUNT(*) as total_clicks')
            ->whereDate('created_at', '>=', now()->subDays(6)->toDateString())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('click_date')
            ->get();

        $chartDays = collect(range(0, 6))
            ->map(fn ($day) => now()->subDays(6 - $day)->format('Y-m-d'));

        $chartLabels = $chartDays->map(fn ($day) => \Carbon\Carbon::parse($day)->translatedFormat('d M'));
        $chartSeries = $chartDays->map(function ($day) use ($dailyClicks) {
            return (int) optional($dailyClicks->firstWhere('click_date', $day))->total_clicks;
        });

        return view('admin.dashboard', compact(
            'stats',
            'topLinks',
            'recentClicks',
            'dailyClicks',
            'chartLabels',
            'chartSeries'
        ));
    }

    public function analytics()
    {
        $recentVisits = PageVisit::latest()->paginate(20, ['*'], 'visits_page');

        $recentClicks = LinkClick::with('bioLink')
            ->latest()
            ->paginate(20, ['*'], 'clicks_page');

        $clickSummary = BioLink::withCount('clicks')
            ->orderByDesc('clicks_count')
            ->orderBy('title')
            ->get();

        $summary = [
            'total_visits' => PageVisit::count(),
            'unique_visitors' => PageVisit::query()->whereNotNull('session_id')->distinct('session_id')->count('session_id'),
            'total_clicks' => LinkClick::count(),
            'active_links' => BioLink::where('is_active', true)->count(),
        ];

        return view('admin.analytics.index', compact('recentVisits', 'recentClicks', 'clickSummary', 'summary'));
    }
}
