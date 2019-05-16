<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
    protected $fillable = [
        'username', 'password', 'al_id', 'employee_id', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'employeeid');
    }
    
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
    
}
