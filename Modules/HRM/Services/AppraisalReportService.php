<?php


namespace Modules\HRM\Services;


use App\Traits\CrudTrait;
use App\Traits\MailSender;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Repositories\AppraisalReportRepository;

class AppraisalReportService
{
    use CrudTrait, NotificationTrait, MailSender;
    private $appraisalReportRepository;


    public function __construct(AppraisalReportRepository $appraisalReportRepository)
    {
        $this->appraisalReportRepository = $appraisalReportRepository;
        $this->setActionRepository($appraisalReportRepository);
    }


    public function saveReport(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data['requester_id'] = auth()->user()->employee->id;
            $appraisalReport = $this->save($data);

            return $appraisalReport;
        });
    }
}
