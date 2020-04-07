<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class StateRecipient extends Model
{
    protected $fillable = ['state_history_id', 'user_id', 'created_at', 'updated_at'];
}
