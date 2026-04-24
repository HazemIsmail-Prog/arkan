<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Models\RequiredApproval;
use App\Models\Equipment;
use Carbon\Carbon;
use App\Models\Setting;

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


        $setting = Setting::first();

        
            
        // Work progress
        $workProgressPct = $setting ? $setting->work_progress : 0;

        // Project timeline
        // project time line is based on the project start date and the project end date and the current date
        $projectStartDate = $setting ? $setting->project_start_date : null;
        $projectEndDate = $setting ? $setting->project_end_date : null;
        $currentDate = now();
        $projectDuration = Carbon::parse($projectEndDate)->diffInDays(Carbon::parse($projectStartDate));
        $currentProgress = Carbon::parse($currentDate)->diffInDays(Carbon::parse($projectStartDate));
        $timelineProgressPct = 0;
        if($projectStartDate && $projectEndDate){
            $timelineProgressPct = round(($currentProgress / $projectDuration) * 100, 1);
        }

        $images = $setting ? $setting->attachments->pluck('view_url') : [];

        // $images = [
        //     'https://picsum.photos/seed/arkan-a/960/540',
        //     'https://picsum.photos/seed/arkan-b/960/540',
        //     'https://picsum.photos/seed/arkan-c/960/540',
        //     'https://picsum.photos/seed/arkan-d/960/540',
        // ];

        $approvals = RequiredApproval::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $equipment = Equipment::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $dashboardPayload = [
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
