<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CompanyInterface;
use App\Models\Company;

class CompanyRepository implements CompanyInterface{

        public function findById($id){
            return Company::with('vacancies')->findOrFail($id);
        }

        public function index(){
            return Company::with('vacancies')->paginate(10);
        }

        public function storeCompany(array $data){
            return Company::create($data);
        }

        public function deleteCompany($id)
        {
            return Company::delete($id);
        }

        public function updateCompany(array $data, $id)
        {
            $company = Company::findOrFail($id);

            $company->update($data);

            return $company;
        }

}