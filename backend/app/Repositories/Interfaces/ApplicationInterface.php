<?php

namespace App\Repositories\Interfaces;

interface ApplicationInterface
{
    public function findById($id);

    public function storeApplication(array $data);

    public function deleteApplication($id);

    public function updateApplication(array $data, $id);
}
