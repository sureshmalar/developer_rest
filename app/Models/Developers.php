<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Developers extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $table = 'developers';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name', 
        'last_name',
        'email', 
        'password',
        'confirm_password',
        'phone_number', 
        'address', 
        'profile_pic',
        'image_name'
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'confirm_password',
        'remember_token',

    ];

    public function setPasswordAttribute($pass)
    {
      $this->attributes['password'] = Hash::make($pass);
    }

    
}
