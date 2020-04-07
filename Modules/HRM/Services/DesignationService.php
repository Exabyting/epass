<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/30/2018
 * Time: 12:43 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Illuminate\Http\Response;
use Modules\HRM\Repositories\DesignationRepository;

class DesignationService
{
    use CrudTrait;
    protected $designationRepository;

    public function __construct(DesignationRepository $designationRepository)
    {
        $this->designationRepository = $designationRepository;
        $this->setActionRepository($this->designationRepository);
    }

    public function getDesignationList()
    {
        return $this->designationRepository->findAll(null, null, ['column' => 'id', 'direction' => 'asc']);
    }

    public function getDesignations()
    {
        return $this->designationRepository->findAll()->pluck('name', 'id')->toArray();
    }

    public function storeDesignation($data)
    {
        $designation = $this->save($data);
        if ($designation) {
            return new Response(trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        }
    }

    public function updateDesignation($data, $id)
    {
        $designation = $this->findOrFail($id);
        $status = $this->update($designation, $data);
        if ($status) {
            return new Response(trans('labels.update_success', ['date' => date('d M Y, h:i A', time())]));
        }
    }

    public function getDesignationByShortCode(array $shortCode)
    {
        return $this->designationRepository->getDesignationsByShortCode($shortCode);
    }

    public function getDesignation($id)
    {
        return $this->findOrFail($id);
    }

}
