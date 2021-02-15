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

    // abstract function getLoggedInUser(int $id);
    // abstract function createLocalLdap(array $data);
    // abstract function getDetails(int $id);
    // abstract function update(int $id, array $data);
    // abstract function updateLdapUser(int $id, array $data);
    // abstract function delete(int $id);
}
