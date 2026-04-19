<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Models\RequiredApproval;
use App\Models\Equipment;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        // Project team
        $projectTeam = User::query()
            ->where('is_active', true)
            ->with('company')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
            
        // Work progress
        $workProgressPct = 20;

        // Project timeline
        $timelineProgressPct = 50;

        $timelineData = [
            ['label' => __('Discovery'), 'pct' => 18, 'color' => 'rgb(56 189 248)'],
            ['label' => __('Design'), 'pct' => 22, 'color' => 'rgb(99 102 241)'],
            ['label' => __('Build'), 'pct' => 35, 'color' => 'rgb(34 197 94)'],
            ['label' => __('Delivery'), 'pct' => 25, 'color' => 'rgb(161 161 170)'],
        ];

        $images = [
            'https://picsum.photos/seed/arkan-a/960/540',
            'https://picsum.photos/seed/arkan-b/960/540',
            'https://picsum.photos/seed/arkan-c/960/540',
            'https://picsum.photos/seed/arkan-d/960/540',
        ];

        $approvals = RequiredApproval::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $equipment = Equipment::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $dashboardPayload = [
            'timelineSegments' => $timelineData,
            'timelineProgressPct' => $timelineProgressPct,
            'workProgressPct' => $workProgressPct,
            'galleryImages' => $images,
            'approvals' => $approvals,
            'projectTeam' => $projectTeam,
            'equipment' => $equipment,
        ];

        return view('dashboard', compact('dashboardPayload'));
    }
}
