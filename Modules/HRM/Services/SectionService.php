<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 6/24/19
 * Time: 1:01 PM
 */

namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use Modules\HRM\Repositories\SectionRepository;

class SectionService
{
    use CrudTrait;
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
        $this->setActionRepository($this->sectionRepository);
    }

    public function storeSection($data)
    {
        return $this->save($data);
    }

    public function updateSection($data, $id)
    {
        $section = $this->findOrFail($id);
        return $section->update($data);
    }
}
