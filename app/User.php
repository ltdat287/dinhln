<?php

namespace VirtualProject;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kodeine\Acl\Traits\HasRole;
use Kodeine\Acl\Models\Eloquent\Role;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    
    use Authenticatable, CanResetPassword, HasRole;

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
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];
    
    /**
     * Get boss object
     * 
     * @return Ambigous <\Illuminate\Support\Collection, \Illuminate\Database\Eloquent\static, NULL>
     */
    public function boss()
    {
        return self::find($this->boss_id);
    }
    
    /**
     * Get first role object
     * 
     * @return Kodeine\Acl\Models\Role
     */
    public function getFirstRole()
    {
        $role = null;
        $roles = self::getRoles();
        if (count($roles)) {
            $role = Role::where('slug', '=', $roles[0])->first();
        }
        return $role;
    }
    
    /**
     * Get bosses not disable from db.
     * 
     * @return objects
     */
    public static function getBosses()
    {
        $results = self::where('disabled', '=', false)->role('boss')->get();
        return $results;
    }
    
    /**
     * Get user not disable from db.
     * 
     * @return objects
     */
    public static function getUsers()
    {
        $results = self::where('disabled', '=', false)->orderBy('updated_at', 'DESC');
        return $results;
    }
}
