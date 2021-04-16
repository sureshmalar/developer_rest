<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Developers;
use App\Service\DeveloperService;
use App\Requests\DevelopersRequest;
use Auth;
class DevelopersController extends Controller
{

    /**
     * @var App\Service\DeveloperService
     */
    protected $developerService;

    public function __construct(DeveloperService $developerService)
    {
        $this->developerService = $developerService;
    }

    /**
     * Register Developers
     * @param App\Requests\DevelopersRequest
     * @return json
     */
      public function registerDevelopers(DevelopersRequest $request)
    {
        try {
            $result = ['status' => 200];
            $registerData = $request->validate([
                'first_name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'phone_number' => 'required'
            ]);
            $user = $this->developerService->registerDevelopers($request->developers());
            $accessToken = $user->createToken('authToken')->accessToken;
            $result = [
                'data' => $user,
                'access_token' => $accessToken,
                'status' => 200
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'access_token' => $accessToken,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * return list of developers
     * @return json
     */
    public function getAllDevelopers( )
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->developerService->getAllDevelopers();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }


     /**
     * Update Developer based on id
     * @param App\Requests\DevelopersRequest
     * @return json
     */
    public function updateDevelopers(DevelopersRequest $request)
    {
        try {
            $result = ['status' => 200];
            Log::info($request->developers());
            $result['data'] = $this->developerService->updateDevelopers($request->developers(),$request['id']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }


     /**
     * Delete single Developer based on id
     * @param int
     * @return json
     */
    public function deleteDevelopers($id)
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->developerService->deleteDevelopers($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * login Developers based on email and password
     * 
     * @param Request
     * @return json
     */
    public function loginDevelopers(Request $request)
    {
        try {
            //validation
            $loginData = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

             $data = $this->developerService->loginDeveloper($request);
            if ($data == false) {
                return response(['message' => 'Invalid Credentials']);
            }
            else
            {
            //create access token
            $accessToken = $data->createToken('authToken')->accessToken;            
            $result = [
                'user' => $data, 
                'access_token' => $accessToken,
                'status' => 200
            ];
        }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * delete multiple developers record
     * @param Request
     * @return json
     */
        public function deleteMultipleDevelopers(Request $request)
    {  
        try {
            $result = ['status' => 200];
            $result['data'] = $this->developerService->deleteMultipleDevelopers($request['ids']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }


     /**
     * Update Password based on id
     * @param Request
     * @return json
     */
    public function getDevelopersById(Request $request)
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->developerService->getDevelopersById($request['id']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    /**
     * Update Password based on email
     * @param Request
     * @return json
     */
    public function forgotPassword(Request $request)
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->developerService->forgotPassword($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

}
