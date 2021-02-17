<?php

namespace Modules\Tasks\Repositories\Contracts;

use App\Repositories\Pager;
use App\Repositories\Sorter;

abstract class TaskRepositoryContract
{
    use Sorter;
    use Pager;

    abstract function create(array $data);
    abstract function rules(array $merge = [], $id = null);
    abstract function getSortableColumns();
    abstract function getUserTasksAll(array $requestData);
    abstract function getUserTasksAllCount(array $requestData);
}
