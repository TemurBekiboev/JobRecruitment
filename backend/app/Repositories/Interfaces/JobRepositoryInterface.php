<?php

namespace App\Repositories\Interfaces;

interface JobRepositoryInterface {

    public function findById($id);

    public function storeVacancy(array $data);

    public function deleteVacancy($id);

    public function updateVacancy(array $data, $id);
}

