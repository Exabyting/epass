<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/28/2018
 * Time: 6:26 PM
 */

namespace Modules\HRM\Services;


use App\Http\Responses\DataResponse;
use App\Traits\CrudTrait;
use Closure;
use Illuminate\Http\Response;
use Modules\HRM\Repositories\DepartmentRepository;

class DepartmentService
{
    use  CrudTrait;
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->setActionRepository($this->departmentRepository);
    }


    public function storeDepartment($data)
    {
        $department = $this->save($data);

        return new DataResponse($department, $department->id, trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));

    }

    public function updateDepartment($data, $id)
    {
        $department = $this->findOrFail($id);
        $status = $department->update($data);
        if ($status) {
            return new DataResponse($department, $department->id, trans('labels.update_success', ['date' => date('d M Y, h:i A', time())]));
        }
    }

//	getDepartmentList providing the list of department by collection
    public function getDepartmentList()
    {
        return $this->departmentRepository->findAll();

    }

//	getDepartments providing department list with array for employee creation
    public function getDepartments()
    {
        return $this->departmentRepository->findAll()->pluck('name', 'id')->toArray();
    }

    public function getDepartmentById($id)
    {
        return $this->departmentRepository->findOrFail($id);
    }

    public function deleteDepartment($id)
    {
        $department = $this->findOrFail($id);
        $status = $department->delete();
        if ($status) {
            return new Response(trans('labels.delete_success', ['date' => date('d M Y, h:i A', time())]));
        }
    }

    public function getDepartmentsForDropdown(Closure $implementedValue = null, Closure $implementedKey = null)
    {
        $departments = $this->departmentRepository->findAll();

        $departmentOptions = [];

        foreach ($departments as $department) {
            $departmentId = $implementedKey ? $implementedKey($department) : $department->id;

            $implementedValue = $implementedValue ?: function ($department) {
                return $department->name;
            };

            $departmentOptions[$departmentId] = $implementedValue($department);
        }

        return $departmentOptions;
    }
}
