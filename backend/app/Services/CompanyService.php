<?php

namespace App\Services;

use App\Http\Resources\CompanyResource;
use App\Repositories\Interfaces\CompanyInterface;

class CompanyService {

    protected $companyRepo;

    public function __construct(CompanyInterface $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    public function index()
    {
        $company = $this->companyRepo->index();
        return CompanyResource::collection($company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        $company =  $this->companyRepo->storeCompany($data);

        return $company;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = $this->companyRepo->findById($id);

        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, string $id)
    {
        $company = $this->companyRepo->updateCompany($data, $id);

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = $this->companyRepo->deleteCompany($id);

        return $company;
    }

}