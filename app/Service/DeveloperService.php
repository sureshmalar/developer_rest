<?php

namespace App\Service;
use App\Models\Developers;


interface DeveloperService {

    public function registerDevelopers(Developers $data);
    public function updateDevelopers(Developers $data,$id);
    public function deleteDevelopers($id);
    public function loginDeveloper($data);
    public function getAllDevelopers();
    public function deleteMultipleDevelopers($id);
    public function getDevelopersById($id);
    public function forgotPassword($request);
    
}
