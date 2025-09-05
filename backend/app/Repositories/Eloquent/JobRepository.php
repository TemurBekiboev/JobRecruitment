<?php

namespace App\Repositories\Eloquent;

use App\Models\Vacancy;
use App\Repositories\Interfaces\JobRepositoryInterface;

class JobRepository implements JobRepositoryInterface
{

        public function findById($id){
            return Vacancy::findOrFail($id);
        }

        public function storeVacancy(array $data){
            return Vacancy::create($data);
        }

        public function deleteVacancy($id)
        {
            return Vacancy::delete($id);
        }

        public function updateVacancy(array $data, $id)
        {
            $vacancy = Vacancy::findOrFail($id);

            $vacancy->update($data);

            return $vacancy;
        }
}