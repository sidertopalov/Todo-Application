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
    abstract function getLoggedInUser(int $id);
}
