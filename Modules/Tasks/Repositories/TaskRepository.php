<?php


namespace Modules\Tasks\Repositories;

use Illuminate\Support\Facades\Schema;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Repositories\Contracts\TaskRepositoryContract;

class TaskRepository extends TaskRepositoryContract
{
    public function getUserTasksAll(array $requestData)
    {
        $query = Task::query();
        $this->applyUserWheres($query, $requestData);
        $this->setPaging($query, $requestData['limit'], $requestData['offset']);
        $this->setOrder($query, 'created_at', 'desc', $this->getSortableColumns());
        // $this->setOrder($query, $requestData['sortField'], $requestData['sortDirection'], $this->getSortableColumns());

        return $query
            ->with('status')
            ->get();
    }

    public function getUserTasksAllCount(array $requestData)
    {
        $query = Task::query();
        $this->applyUserWheres($query, $requestData);

        return $query->count();
    }

    public function create(array $data)
    {
        $task = Task::create($data);
        return Task::with('status')->find($task->id);
    }

    public function rules(array $merge = [], $id = null)
    {
        return Task::rules($merge, $id);
    }

    public function getSortableColumns()
    {
        return get_columns_in_lowercase(Schema::getColumnListing('tasks'));
    }

    private function applyUserWheres(&$query, $requestData)
    {
        $query->where('tasks.user_id', '=', $requestData['user_id']);
    }
}
