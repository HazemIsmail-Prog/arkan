<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{

    public function edit(Request $request)
    {
        abort_if(!$request->user()->hasPermissionTo('update_setting'), 403);

        if($request->wantsJson()){
            return response()->json(Setting::with('attachments')->first());
        }

        return view('pages.settings');
    }

    public function update(Request $request)
    {
        if(!$request->user()->hasPermissionTo('update_setting')){
            return response()->json([
                'message' => 'Unauthorized action.',
            ], 403);
        }
        $validated = $request->validate([
            'project_start_date' => 'required|date|before:project_end_date',
            'project_end_date' => 'required|date|after:project_start_date',
            'work_progress' => 'required|numeric|min:0|max:100',
        ]);
        $setting = Setting::updateOrCreate(['id' => 1], $validated);
        return response()->json($setting);
    }
}
