<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class NGAppraisalRequestAction extends Model
{
    protected $table = 'ng_appraisal_request_actions';

    protected $fillable = ['appraisal_request_id', 'actor_id', 'rating', 'comment', 'action'];

    public function appraisalRequest()
    {
        return $this->belongsTo(NGAppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }
}
