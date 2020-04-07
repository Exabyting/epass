<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Modules\HRM\Entities\Employee;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'user_type',
        'mobile',
        'reference_table_id',
        'last_password_change',
        'status',
        'is_special',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Entities\Role')
            ->withTimestamps();
    }

    public function hasPermission($permissionName, $modelName)
    {
        $roles = $this->roles()->get();
        foreach ($roles as $role) {
            if ($role->hasPermission($permissionName, $modelName)) {
                return true;
            }
        }
        return false;
    }

    /*public function employeeInfo()
    {
        return Employee::where('employee_id', $this->username)->first();
    }*/

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'username', 'employee_id');
    }

    /*
     * Returns user's department department_code if user
     * is an employee
     * */
    public function getDepartmentCode()
    {
        return Arr::get($this, 'employee.department.department_code');
    }
}
