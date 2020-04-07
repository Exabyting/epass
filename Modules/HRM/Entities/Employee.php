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
        'signature',
		'email',
		'gender',
		'department_id',
        'section_id',
		'designation_id',
        'is_divisional_director',
		'status',
		'tel_office',
		'tel_home',
		'mobile_one',
		'mobile_two'
	];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
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
        if ($this->tel_office) {
            return $this->tel_office;
        } else if ($this->tel_home) {
            return $this->tel_home;
        } else if ($this->mobile_one) {
            return $this->mobile_one;
        } else if ($this->mobile_two) {
            return $this->mobile_two;
        } else {
            return null;
        }
	}

	public function employees(){
        return $this->hasMany(EmployeeOfficer::class, 'iro_id', 'id');
    }

    public function officers(){
        return $this->hasMany(EmployeeOfficer::class, 'employee_id', 'id');
    }
}
