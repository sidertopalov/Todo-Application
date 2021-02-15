<?php


namespace Modules\Users\Services;

use App\Http\Resources\GeneralResponse;
use App\Http\Resources\GeneralSingleResourceResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Users\Repositories\Contracts\UserRepositoryContract;

class UserService
{
    private $userRepository;

    public function __construct(
        UserRepositoryContract $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        try {
            return $this->createUser($data);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    private function createUser($data)
    {

        $v = Validator::make($data, $this->userRepository->rules([
            'password' => 'required|confirmed|min:6',
        ]));

        if ($v->fails()) {
            return (new GeneralResponse())->withCode(400)->withStatus("error")->withMessage($v->errors());
        }

        try {
            $user = $this->userRepository->create($data);
            // $this->syncRoles($user, $data);
        } catch (\Throwable $e) {
            throw $e;
        }

        return (new GeneralSingleResourceResponse($user));
    }
}
