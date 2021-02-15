<?php

namespace Modules\Tasks\Http\Controllers;

use App\Repositories\Pager;
use App\Repositories\Sorter;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Tasks\Services\TaskService;

class TaskController extends Controller
{
    use Pager, Sorter;

    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getUserTasks(Request $request)
    {
        $statusCode = 200;

        $requestData = [
            'limit'         => $request->limit,
            'offset'        => $request->offset
        ];

        $dataResponse = $this->taskService->getUserTasksAll($requestData);
        if (!empty($dataResponse->code)) {
            $statusCode = $dataResponse->code;
        }

        return $dataResponse->response()->setStatusCode($statusCode);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $statusCode = 201;
        $data = $this->taskService->create($request->all());
        if (!empty($data->code)) {
            $statusCode = $data->code;
        }

        return $data->response()->setStatusCode($statusCode);
    }
}
