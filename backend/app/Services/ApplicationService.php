<?php

namespace App\Services;

use App\Events\ApplicationCreated;
use App\Repositories\Interfaces\ApplicationInterface;

class ApplicationService{

    protected $application_interface;

    public function __construct(ApplicationInterface $application_interface)
    {
        $this->application_interface = $application_interface;
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
    public function store(array $data)
    {
        $application = $this->application_interface->storeApplication($data);

        return $application;
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
    public function update(array $data, string $id)
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