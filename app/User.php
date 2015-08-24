<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullname', 'username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Change password or current password
     * @param $oldPassword
     * @param $password
     * @return boolean true if password changed and false if old password doesn't match
     */
    public function changePassword($oldPassword, $password)
    {
        if(Hash::check($oldPassword,$this->attributes['password'])){
            $this->attributes['password'] = bcrypt($password);
            return true;
        }
        return false;
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
