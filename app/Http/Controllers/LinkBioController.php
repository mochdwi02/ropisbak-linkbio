<?php

namespace App\Http\Controllers;

use App\Models\BioLink;
use App\Models\LinkClick;
use App\Models\PageVisit;
use Illuminate\Http\Request;

class LinkBioController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->session()->getId();

        $hasRecentVisit = PageVisit::query()
            ->where('session_id', $sessionId)
            ->where('created_at', '>=', now()->subMinutes(30))
            ->exists();

        if (! $hasRecentVisit) {
            PageVisit::create([
                'session_id' => $sessionId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->headers->get('referer'),
            ]);
        }

        $groupedLinks = BioLink::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->groupBy('category');

        return view('linkbio.index', [
            'groupedLinks' => $groupedLinks,
        ]);
    }

    public function go(Request $request, BioLink $bioLink)
    {
        if (! $bioLink->is_active) {
            abort(404);
        }

        LinkClick::create([
            'bio_link_id' => $bioLink->id,
            'session_id' => $request->session()->getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->away($bioLink->url);
    }
}
