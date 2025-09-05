<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = $this->companyService->index();

        return response()->json($company, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        Gate::authorize('create', Company::class);

        $company = $this->companyService->store($request->validated());

        return response()->json($company, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = $this->companyService->show($id);

        return response()->json($company, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = $this->companyService->update($request->validated(), $id);

        return response()->json($company, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->companyService->destroy($id);
    }
}
