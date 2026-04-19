<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequiredApproval;
use Illuminate\Http\JsonResponse;

class RequiredApprovalController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->hasPermissionTo('view_all_requiredapproval'), 403);
        if (request()->wantsJson()) {
            return RequiredApproval::query()
                ->orderBy('title', 'asc')
                ->paginate(request()->per_page ?? 10);
        }
        return view('pages.approvals');
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->hasPermissionTo('create_requiredapproval'), 403);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authority' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        $requiredApproval = RequiredApproval::create($validated);
        return response()->json($requiredApproval, JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, RequiredApproval $requiredApproval)
    {
        abort_if(!auth()->user()->hasPermissionTo('update_requiredapproval'), 403);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authority' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        $requiredApproval->update($validated);
        return response()->json($requiredApproval);
    }

    public function destroy(RequiredApproval $requiredApproval)
    {
        abort_if(!auth()->user()->hasPermissionTo('delete_requiredapproval'), 403);
        $requiredApproval->delete();
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
