<?php

namespace Modules\Tasks\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Tasks\Entities\Task;

class CanUserDeleteTaskRule implements Rule
{

    private $taskId;
    private $userId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($taskId, $userId)
    {
        $this->taskId = $taskId;
        $this->userId = $userId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $task = Task::where('user_id', $this->userId)->find($this->taskId);
        return (bool) ($task !== null);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Task does not exists.';
    }
}
