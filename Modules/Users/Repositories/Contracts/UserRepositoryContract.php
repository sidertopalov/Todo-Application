<?php

namespace Modules\Users\Repositories\Contracts;

use App\Repositories\Pager;
use App\Repositories\Sorter;

abstract class UserRepositoryContract
{
    use Sorter;
    use Pager;

    abstract function create(array $data);
    abstract function rules(array $merge = [], $id = null);
    abstract function getSortableColumns();

    // abstract function getAll(array $requestData);
    // abstract function getTotalCount(array $requestData);
    // abstract function getLoggedInUser(int $id);
    // abstract function createLocalLdap(array $data);
    // abstract function getDetails(int $id);
    // abstract function update(int $id, array $data);
    // abstract function updateLdapUser(int $id, array $data);
    // abstract function delete(int $id);
}
