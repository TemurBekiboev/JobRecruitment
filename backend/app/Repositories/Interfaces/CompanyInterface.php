<?php

namespace App\Repositories\Interfaces;

interface CompanyInterface
{
    public function findById($id);

    public function index();

    public function storeCompany(array $data);

    public function deleteCompany($id);

    public function updateCompany(array $data, $id);
}
