<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/22/2018
 * Time: 2:53 PM
 */

namespace Modules\HRM\Repositories;

use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\Employee;

class EmployeeRepository extends AbstractBaseRepository
{
    public $modelName = Employee::class;


//	public function getEmployeeInformation( $id ) {
////		dd($data);
//		$test = $this->findOne( $id );
//		dd( $test );
//	}

    public function getEmployeeTitleNames()
    {
        return [
            'Mr.' => 'Mr.',
            'Ms.' => 'Ms.',
            'Mrs.' => 'Mrs.',
            'Miss.' => 'Miss.',
            'Dr.' => 'Dr.',
            'Engr.' => 'Engr.',
            'Dr.' => 'Dr.',
        ];
    }

    public function getSalaryScale()
    {
        return [
            'Grade 1' => 'Grade 1',
            'Grade 2' => 'Grade 2',
            'Grade 3' => 'Grade 3',
            'Grade 4' => 'Grade 4',
            'Grade 5' => 'Grade 5',
            'Grade 6' => 'Grade 6',
            'Grade 7' => 'Grade 7',
            'Grade 8' => 'Grade 8',
        ];
    }




}