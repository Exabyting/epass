<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\IMS\Entities\InventoryLocation;

class Department extends Model
{
	protected $table = "departments";
    protected $fillable = ['name', 'department_code'];

    public function inventoryLocations()
    {
        return $this->hasMany(InventoryLocation::class, 'department_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
