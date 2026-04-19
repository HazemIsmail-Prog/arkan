<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;

class EquipmentController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->hasPermissionTo('view_all_equipment'), 403);
        if (request()->wantsJson()) {
            return Equipment::query()
                ->orderBy('name', 'asc')
                ->paginate(request()->per_page ?? 10);
        }
        return view('pages.equipment');
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasPermissionTo('create_equipment'), 403);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $equipment = Equipment::create($validated);
        return response()->json($equipment, JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, Equipment $equipment)
    {
        abort_if(!auth()->user()->hasPermissionTo('update_equipment'), 403);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $equipment->update($validated);
        return response()->json($equipment);
    }

    public function destroy(Equipment $equipment)
    {
        abort_if(!auth()->user()->hasPermissionTo('delete_equipment'), 403);
        $equipment->delete();
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
