<?php


namespace Modules\Users\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Modules\Users\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends UserRepositoryContract
{
    public function create(array $data)
    {
        $data['password'] = User::hashPassword($data['password']);

        return User::create($data);
    }

    public function rules(array $merge = [], $id = null)
    {
        return User::rules($merge, $id);
    }

    public function getSortableColumns()
    {
        return get_columns_in_lowercase(Schema::getColumnListing('users'));
    }
}
