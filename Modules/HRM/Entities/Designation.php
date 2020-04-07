<?php

namespace Modules\HRM\Entities;

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = "designations";
    protected $fillable = ['name', 'short_name'];

    public function user()
    {
        return $this->hasManyThrough(User::class, Employee::class, 'designation_id', 'username', 'id', 'employee_id');
    }

}
