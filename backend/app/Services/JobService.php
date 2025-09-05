<?php

namespace App\Services;

use App\Models\Vacancy;
use App\Repositories\Interfaces\JobRepositoryInterface;

class JobService {

    protected $jobRepo;

    public function __construct(JobRepositoryInterface $jobRepo){
        $this->jobRepo = $jobRepo;
    }

    public function index(){
        $vacancy = Vacancy::with(['company', 'application'])->paginate(10);

        return $vacancy;
    }

    public function store(array $data){
        return $this->jobRepo->storeVacancy($data);
    }

    public function show($id){
        return $this->jobRepo->findById($id);
    }

    public function update(array $data, $id){
        return $this->jobRepo->updateVacancy($data, $id);
    }

    public function delete($id){
        return $this->jobRepo->deleteVacancy($id);
    }
}