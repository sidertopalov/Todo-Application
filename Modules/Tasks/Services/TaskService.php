<?php


namespace Modules\Tasks\Services;

use App\Http\Resources\GeneralResponse;
use App\Http\Resources\GeneralSingleResourceResponse;
use App\Http\Resources\GeneralSmartDataListingResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Tasks\Repositories\Contracts\TaskRepositoryContract;

class TaskService
{
    private $taskRepository;

    public function __construct(
        TaskRepositoryContract $taskRepository
    ) {
        $this->taskRepository = $taskRepository;
    }

    public function getUserTasksAll(array $requestData)
    {
        $requestData['user_id'] = auth()->user()->id;
        $v = Validator::make(
            $requestData,
            [
                'limit' => 'nullable',
                'offset' => 'nullable|integer'
            ]
        );

        if ($v->fails()) {
            return (new GeneralResponse())->withCode(400)->withStatus("error")->withMessage($v->errors());
        }

        try {
            $data = $this->taskRepository->getUserTasksAll($requestData);
            $dataCount = $this->taskRepository->getUserTasksAllCount($requestData);
        } catch (\Throwable $e) {
            throw $e;
        }

        return new GeneralSmartDataListingResponse(['result' => $data, 'total' => $dataCount]);
    }

    public function create($data)
    {
        $data['user_id'] = auth()->user()->id;

        $v = Validator::make($data,
            $this->taskRepository->rules()
        );

        if ($v->fails()) {
            return (new GeneralResponse())->withCode(400)->withStatus("error")->withMessage($v->errors());
        }

        try {
            $task = $this->taskRepository->create($data);
        } catch (\Throwable $e) {
            throw $e;
        }

        return (new GeneralSingleResourceResponse($task));
    }
}
