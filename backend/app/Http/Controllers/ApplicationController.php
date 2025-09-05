<?php

namespace App\Http\Controllers;

use App\Events\ApplicationCreated;
use App\Http\Requests\ApplicationRequest;
use App\Services\ApplicationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    protected $application_service;

    public function __construct(ApplicationService $application_service)
    {
        $this->application_service = $application_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApplicationRequest $request)
    {
        $application = $this->application_service->store($request->validated());

        event(new ApplicationCreated($application));

        return response()->json('Application Created!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
