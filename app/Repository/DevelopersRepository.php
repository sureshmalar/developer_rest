<?php

namespace App\Repository;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Developers;


class DevelopersRepository
{

    protected $developers;

    public function __construct(Developers $developers)
    {
        $this->developers = $developers;
    }

    /**
     * return list of developers
     */
    public function getAllDevelopers()
    {
        $data = DB::table('developers')->get();
        $result = [
            'result' => $data
        ];
        return $result;
    }

    /**
     * create record
     */
    public function registerDevelopers(Developers $request)
    {
         $request->save();
        return $request->fresh();
    }

    /**
     * update record based on id
     */
    public function updateDevelopers(Developers $data, $id)
    {
        $developers = Developers::find($id);
        $developers->update($data->toArray());
        return $developers;
    }

    /**
     * Delete single records
     */
    public function deleteDevelopers($id)
    {
        $developers = Developers::find($id);
        $developers->delete();
        return $developers;
    }

    /**
     * Delete multiple records
     */
    public function deleteMultipleDevelopers($id)
    {  
            $ids = explode(",", $id);
            Developers::whereIn('id', $ids)->delete();  
    }
   
    public function loginDeveloper($email, $password)
    {  
        $user = Developers::where('email', '=', $email)->first();
        if(Hash::check($password,$user['password']))
        {
            return $user;
        }
        return false;
    }
    
    /**
     * Get Developer record by id
     */
    public function getDevelopersById($id)
    {
        $res = Developers::where('id', '=', $id)->first();
        $result = [
            'result' => $res
        ];
        return $result;
    }

    
     /**
     * Forgot Password record by id
     */
    public function forgotPassword($data)
    {
        $result = [];
        if(Arr::exists($data,'password') && Arr::exists($data,'confirm_password')){
            $password = Hash::make($data['password']);
            $result = Developers::where("email","=",$data['email'])->update(['password'=>$password,'confirm_password'=>$data['confirm_password']]);
        }
        return $result;
    }
}
