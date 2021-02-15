<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    const TO_BE_DONE = 1;
    const COMPLETED = 2;

    protected $fillable = [];

    public $timestamp = false;
}
