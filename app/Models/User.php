<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    static $rules       = [ ];

    protected $perPage  = 20;
    protected $fillable = [ ];

    protected $hidden = [
                        'password',
                        'remember_token',
                        ];

    protected $casts =  [
                        'email_verified_at' => 'datetime',
                        ];


    public function adminlte_image(){
        return 'img/userIcon.jpg';
    }

    public function adminlte_desc(){
        return 'Hola';
    }

    public function adminlte_profile_url(){
        return 'profile/username';
    }


}
