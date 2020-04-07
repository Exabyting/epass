<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequestApproval extends Model
{
    protected $table = 'gco_appraisal_request_approvals';

    protected $fillable = [
        'appraisal_request_id',
        'filled_up_date',
        'cause_of_late',
        'work_on_application',
        'actor_id',
        'status',
    ];

    public function appraisalRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }

}
