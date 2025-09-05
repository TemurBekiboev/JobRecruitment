<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Models\Vacancy;
use App\Services\JobService;
use Illuminate\Support\Facades\Gate;

class VacancyController extends Controller
{
    
    protected $jobService;

    public function __construct(JobService $jobService){
        $this->jobService = $jobService;
    }

    public function index()
    {
        $vacancies = $this->jobService->index();

        return response()->json($vacancies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacancyRequest $request)
    {
        Gate::authorize('create', Vacancy::class);

        $data = $this->jobService->store($request->validated());

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->jobService->show($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacancyRequest $request, string $id)
    {
        $update = $this->jobService->update($request->validated(),$id);

        return response()->json($update, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy = $this->jobService->delete($id);

        return response()->json($destroy,200);
    }
}
