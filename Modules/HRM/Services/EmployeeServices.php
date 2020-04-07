<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/22/2018
 * Time: 2:58 PM
 */

namespace Modules\HRM\Services;

use App\Http\Responses\DataResponse;
use App\Services\UserService;
use App\Traits\CrudTrait;
use App\Traits\FileTrait;
use App\Utilities\DropDownDataFormatter;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\HRM\Entities\EmployeeOfficer;
use Modules\HRM\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Hash;

class EmployeeServices
{
    use CrudTrait, FileTrait;
    private const EMPLOYEE_PROFILE_PHOTO_PATH = 'employee/';
    private const EMPLOYEE_SIGNATURE_PHOTO_PATH = 'employee/signature/';
    private $employeeRepository;
    private $userService;

    public function __construct(EmployeeRepository $employeeRepository, UserService $userService)
    {
        $this->employeeRepository = $employeeRepository;
        $this->userService = $userService;
        $this->setActionRepository($this->employeeRepository);
    }

    public function storeGeneralInfo($data = [])
    {
        $fullName = $this->splitFullName($data);

        $data['first_name'] = isset($fullName[1]) ? $fullName[1] : $data['name'];
        $data['last_name'] = isset($fullName[2]) ? $fullName[2] : '';

        if (isset($data['photo'])) {
            $file = $data['photo'];
            $photoName = time() . md5_file($file->getRealPath()) . '.' . $file->guessExtension();
            $file->storeAs(self::EMPLOYEE_PROFILE_PHOTO_PATH, $photoName, $this->disk);
            $data['photo'] = self::EMPLOYEE_PROFILE_PHOTO_PATH . $photoName;
        }

        if (isset($data['signature'])) {
            $signature = $data['signature'];
            $signatureName = time() . md5_file($signature->getRealPath()) . '.' . $signature->guessExtension();
            $signature->storeAs(self::EMPLOYEE_SIGNATURE_PHOTO_PATH, $signatureName, $this->disk);
            $data['signature'] = self::EMPLOYEE_SIGNATURE_PHOTO_PATH . $signatureName;
        }

        $generalInfo = $this->employeeRepository->save($data);

        $user = $this->userService->save([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'username' => $data['employee_id'],
            'email' => $data['email'],
            'mobile' => $data['mobile_one'],
            'reference_table_id' => $generalInfo->id,
            'user_type' => config('user.types.EMPLOYEE'),
            'password' => Hash::make(config('user.defaultPassword')),
        ]);


        //dd($user);

        $user->roles()->sync(["2"]);  //Default HRM_ACCESS role


        if(isset($data['employee-officer']) && is_array($data['employee-officer'])) {
            $employee_officers = $data['employee-officer'];
            foreach ($employee_officers as $employee_officer) {
                if ($employee_officer['officer_id'] != NULL) {
                    $employee_officer['employee_id'] = $generalInfo->id;
                    $employeeOfficer = new EmployeeOfficer($employee_officer);
                    $employeeOfficer->save();
                }
            }
        }

        return new DataResponse($generalInfo, $generalInfo['id'], 'General information added successfully');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function splitFullName($data)
    {
        preg_match('~^(.*)\s+([^\s]+)$~', $data['name'], $fullName);
        return $fullName;
    }

    public function updateGeneralInfo($data, $id)
    {
        $fullName = $this->splitFullName($data);

        $data['first_name'] = isset($fullName[1]) ? $fullName[1] : $data['name'];
        $data['last_name'] = isset($fullName[2]) ? $fullName[2] : '';

        $generalInfo = $this->findOrFail($id);

        if (isset($data['photo'])) {
            $file = $data['photo'];
            $photoName = time() . md5_file($file->getRealPath()) . '.' . $file->guessExtension();
            $file->storeAs(self::EMPLOYEE_PROFILE_PHOTO_PATH, $photoName, $this->disk);
            $data['photo'] = self::EMPLOYEE_PROFILE_PHOTO_PATH . $photoName;
        }

        if (isset($data['signature'])) {
            $signature = $data['signature'];
            $signatureName = time() . md5_file($signature->getRealPath()) . '.' . $signature->guessExtension();
            $signature->storeAs(self::EMPLOYEE_SIGNATURE_PHOTO_PATH, $signatureName, $this->disk);
            $data['signature'] = self::EMPLOYEE_SIGNATURE_PHOTO_PATH . $signatureName;
        }

        if ($generalInfo->user) {

            $this->userService->updateUser(
                $generalInfo->user->id,
                [
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'username' => $data['employee_id'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile_one']
                ]
            );
        }

        $status = $generalInfo->update($data);
        if ($status) {
            return new DataResponse($generalInfo, $generalInfo['id'], 'General information updated successfully');
        } else {
            return new DataResponse($generalInfo, $generalInfo['id'], 'Something going wrong !', 500);
        }
    }

    public function getEmployeeList()
    {
        return $this->employeeRepository->findAll();
    }

    public function getEmployeeTitles()
    {
        return $this->employeeRepository->getEmployeeTitleNames();
    }

    public function getEmployeeSalaryScale()
    {
        return $this->employeeRepository->getSalaryScale();
    }

    /**
     * <h3>Employee Dropdown</h3>
     * <p>Custom Implementation of concatenation</p>
     *
     * @param Closure $implementedValue Anonymous Implementation of Value
     * @param Closure $implementedKey Anonymous Implementation Key index
     * @param array|null $query
     * @param bool $isEmptyOption
     * @return array
     */
    public function getEmployeesForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    )
    {
        $employees = $query ? $this->employeeRepository->findBy($query) : $this->employeeRepository->findAll();

        return DropDownDataFormatter::getFormattedDataForDropdown(
            $employees,
            $implementedKey,
            $implementedValue ?: function ($employee) {
                $designation = $employee->designation ? $employee->designation->name : '';
                return $employee->first_name . ' ' . $employee->last_name . ' - '
                    . $designation . ' - ' . $employee->mobile_one;
            },
            $isEmptyOption
        );
    }

    /**
     * @return array
     */
    public function getEmployeesWithOutRequesterDropdown()
    {
        $employees = $this->getEmployeesWithOutRequester();
        return $this->getDropDownEmployeeList($employees);
    }

    private function getEmployeesWithOutRequester()
    {
        return $this->employeeRepository->findAll()->filter(function ($emp) {
            return !$emp->user->hasRole('ROLE_ACR_REQUEST_ACCESS');
        });
    }

    /**
     * @param $employees
     * @return array
     */
    private function getDropDownEmployeeList($employees): array
    {
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $employees,
            null,
            function ($employee) {
                $designation = $employee->designation ? $employee->designation->name : '';
                return $employee->first_name . ' ' . $employee->last_name . ' - '
                    . $designation . ' - ' . $employee->mobile_one;
            }
        );
    }

    public function getRequesterEmployeesDropdown()
    {
        $employees = $this->getEmployeesWithRequester();
        return $this->getDropDownEmployeeList($employees);
    }

    private function getEmployeesWithRequester()
    {
        return $this->employeeRepository->findAll()->filter(function ($emp) {
            return $emp->user->hasRole('ROLE_ACR_REQUEST_ACCESS');
        });
    }

    /**
     * @return array
     */
    public function getEmployeesOnlyRequester()
    {
        return $this->employeeRepository->findAll()->filter(function ($emp) {
            return $emp->user->hasRole('ROLE_ACR_REQUEST_ACCESS');
        });
    }

    public function getIROOfficers(string $officer_type)
    {
        $employee = $this->findOne(auth()->user()->id);
        $officers = $employee->officers->where('is_complete', 0);
        $employees = $this->getOfficerDropDownListByType($officer_type, $officers);
        return $employees->isNotEmpty() ? $employees : ['' => Lang::trans('labels.select')];
    }

    public function getCROOfficer(int $employeeOfficerID)
    {
        $employees = collect();
        $employeeOfficer = EmployeeOfficer::find($employeeOfficerID);
        $formattedEmployeeInformation = $this->formattedOfficerDropDownList($employeeOfficer->cro_id, $employeeOfficer);
        $employees[$employeeOfficer->cro_id] = $formattedEmployeeInformation;
        return $employees->isNotEmpty() ? $employees : ['' => Lang::trans('labels.select')];
    }

    /**
     * @param $officerID
     * @param $employeeOfficer
     * @return string
     */
    private function formattedOfficerDropDownList($officerID, $employeeOfficer): string
    {
        $officerInfo = $this->findOne($officerID);
        return $officerInfo->first_name . " " . $officerInfo->last_name . " ( " .
            $employeeOfficer->start_date . " - " . $employeeOfficer->end_date . " )";
    }

    public function getOfficerEmployees()
    {
        $employee = $this->findOne(auth()->user()->id);
        $officerEmployees = $employee->employees;
        $employees = collect();

        $officerEmployees->each(function ($off) use (&$employees) {
            $employees->push($this->findOne($off->officer_id));
        });
        return $employees ? $this->getDropDownEmployeeList($employees) : [];
    }

    public function storeEmployeeOfficer(array $data)
    {
        return DB::transaction(function () use ($data) {
            $status = false;
            $employee_officers = $data['employee-officer'];
            foreach ($employee_officers as $employee_officer) {
                if ($employee_officer['iro_id'] != NULL && $employee_officer['cro_id'] != NULL) {
                    $employee_officer['employee_id'] = $data['employee_id'];
                    $employeeOfficer = new EmployeeOfficer($employee_officer);
                    $status = $employeeOfficer->save();
                }
            }
            return $status;
        });
    }

    /**
     * @param string $officer_type
     * @param $officers
     * @return mixed
     */
    private function getOfficerDropDownListByType(string $officer_type, $officers)
    {
        $employees = collect();
        if ($officer_type === 'iro') {
            $officers->each(function ($officer) use (&$employees) {
                $dropDownData = $this->formattedOfficerDropDownList($officer->iro_id, $officer);
                $employees[$officer->id] = $dropDownData;
            });
        } else {
            $officers->each(function ($officer) use (&$employees) {
                $dropDownData = $this->formattedOfficerDropDownList($officer->cro_id, $officer);
                $employees[$officer->id] = $dropDownData;
            });
        }
        return $employees;
    }
}
