<?php

namespace Modules\Tasks\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description',
        'user_id',
        'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(TaskStatus::class);
    }

    public static function rules($merge = [], $id = null) {
        return array_merge([
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'status_id' => 'optional|exists:task_statuses,id',
        ], $merge);
    }
}
