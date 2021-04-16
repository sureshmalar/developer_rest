<?php

namespace App\Service;
use App\Models\Developers;
use App\Repository\DevelopersRepository;


class DeveloperServiceImpl implements DeveloperService
{

   
    protected $developersRepository;


    public function __construct(DevelopersRepository $developersRepository)
    {

        $this->developersRepository = $developersRepository;
    }

    
    public function getAllDevelopers()
    {
        $developers = $this->developersRepository->getAllDevelopers();
        return $developers;
    }

    
    public function registerDevelopers(Developers $developers)
    {
        $developers = $this->developersRepository->registerDevelopers($developers);

        return $developers;
    }

    public function updateDevelopers(Developers $developers,$id)
    {
        $developers = $this->developersRepository->updateDevelopers($developers,$id);

        return $developers;
    }

    public function deleteDevelopers($id)
    {
        $developers = $this->developersRepository->deleteDevelopers($id);

        return $developers;
    }

    public function loginDeveloper($developers)
    {
        $username = $developers['email'];
        $password = $developers['password'];
        $developers = $this->developersRepository->loginDeveloper($username,$password);
        return $developers;
    }

    public function deleteMultipleDevelopers($id)
    {
        $developers = $this->developersRepository->deleteMultipleDevelopers($id);

        return $developers;
    }

    
    public function getDevelopersById($id)
    {
        $developers = $this->developersRepository->getDevelopersById($id);
        return $developers;
    }

    
    public function forgotPassword($request)
    {
        $result = "";
        $res = $this->developersRepository->forgotPassword($request);
        if($res == 1)
        {
            $result = "Password Changed Successfully";
        }
        else
        {
            $result = "Password Not Changed";
        }
        return $result;
    }
}
