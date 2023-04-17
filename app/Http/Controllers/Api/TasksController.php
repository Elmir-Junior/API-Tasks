<?php

namespace App\Http\Controllers\Api;

use App\Enums\TasksType;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin|user']);
    }

    public function index()
    {
        try{
            $user = auth()->user();
            $tasks = Task::Where('user_id', $user->id)
            ->orderBy('name')
            ->get();

            return response()->json($tasks, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    public function store(Request $request): JsonResponse
    {
        try{

            $data = $request->all();
            
            $task = Task::create($data);
            
            return response()->json($task, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    public function show(Task $task): JsonResponse
    {
        dd($task);
        try {
            return response()->json($task->load('tasks'), 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }
}
