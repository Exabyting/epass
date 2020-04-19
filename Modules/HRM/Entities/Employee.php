<?php

namespace Modules\HRM\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
	protected $table = "employees";
	protected $fillable = [
        'employee_id',
	    'first_name',
		'last_name',
		'photo',
		'email',
		'gender',
		'department_id',
		'designation_id',
		'status',
		'mobile'
	];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'username', 'employee_id');
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getContact()
    {
        if ($this->mobile) {
            return $this->mobile;
        } else {
            return null;
        }
	}
    public function officers(){
        return $this->hasMany(EmployeeOfficer::class, 'employee_id', 'id');
    }
}
