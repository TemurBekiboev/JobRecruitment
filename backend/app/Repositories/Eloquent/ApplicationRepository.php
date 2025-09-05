<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ApplicationInterface;
use App\Models\Application;

class ApplicationRepository implements ApplicationInterface{

     public function findById($id){
            return Application::findOrFail($id);
        }

        public function storeApplication(array $data){
            return Application::create($data);
        }

        public function deleteApplication($id)
        {
            return Application::delete($id);
        }

        public function updateApplication(array $data, $id)
        {
            $application = Application::findOrFail($id);

            $application->update($data);

            return $application;
        }

}