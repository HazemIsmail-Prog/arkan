<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!$request->user()->hasPermissionTo('view_all_company'), 403);
        if (request()->wantsJson()) {
            return Company::query()
                ->orderBy(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'asc')
                ->paginate(request()->per_page ?? 10);
        }
        return view('pages.companies');
    }

    public function store(Request $request)
    {
        abort_if(!$request->user()->hasPermissionTo('create_company'), 403);
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo_path' => 'nullable|string',
        ]);
        $company = Company::create($validated);
        return response()->json($company, JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, Company $company)
    {
        abort_if(!$request->user()->hasPermissionTo('update_company'), 403);
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo_path' => 'nullable|string',
        ]);
        $company->update($validated);
        return response()->json($company);
    }

    public function destroy(Request $request, Company $company)
    {
        abort_if(!$request->user()->hasPermissionTo('delete_company'), 403);
        $company->delete();
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
