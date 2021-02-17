<?php


namespace Modules\Tasks\Services;

use App\Http\Resources\GeneralResponse;
use App\Http\Resources\GeneralSingleResourceResponse;
use App\Http\Resources\GeneralSmartDataListingResponse;
use Illuminate\Support\Facades\Validator;
use Modules\Tasks\Repositories\Contracts\TaskRepositoryContract;
use Modules\Tasks\Rules\CanUserDeleteTaskRule;

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

    public function update($taskId, $data)
    {
        $rules = $this->taskRepository->rules();
        $v = Validator::make($data, [
            'id'            => 'required|exists:tasks,id',
            'description'   => $rules['description'],
            'status_id'     => 'required|exists:task_statuses,id'
        ]);
        if ($v->fails()) {
            return (new GeneralResponse())->withCode(400)->withStatus("error")->withMessage($v->errors());
        }

        try {
            $task = $this->taskRepository->update($taskId, $data);
        } catch (\Throwable $e) {
            throw $e;
        }

        return (new GeneralSingleResourceResponse($task));

    }

    public function delete($taskId)
    {
        $v = Validator::make(
            [
                'id'        => $taskId
            ],
            [
                'id'        => ['required', 'exists:tasks,id', new CanUserDeleteTaskRule($taskId, auth()->user()->id)]
            ]
        );

        if ($v->fails()) {
            return (new GeneralResponse())->withCode(400)->withStatus("error")->withMessage($v->errors());
        }

        try {
            $task = $this->taskRepository->delete($taskId);
        } catch (\Throwable $e) {
            throw $e;
        }
        return (new GeneralResponse())->withCode(200)->withStatus("ok");
    }
}
