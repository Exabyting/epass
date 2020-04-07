<?php


namespace App\Services;


use App\Repositories\AdminRepository;
use App\Traits\CrudTrait;

class AdminServices
{
    use CrudTrait;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->setActionRepository($adminRepository);
    }

}
