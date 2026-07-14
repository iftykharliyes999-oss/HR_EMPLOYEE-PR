<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * My Tasks
     */
    public function index()
    {
        $tasks = Task::where('employee_id', Auth::id())
            ->latest()
            ->paginate(10);

        $stats = [

            'total' => Task::where('employee_id', Auth::id())->count(),

            'completed' => Task::where('employee_id', Auth::id())
                ->where('status', 'Completed')
                ->count(),

            'pending' => Task::where('employee_id', Auth::id())
                ->where('status', 'Pending')
                ->count(),

            'progress' => Task::where('employee_id', Auth::id())
                ->where('status', 'In Progress')
                ->count(),

        ];

        return view(
            'employee.tasks.index',
            compact(
                'tasks',
                'stats'
            )
        );
    }

    /**
     * Show Task
     */
    public function show(Task $task)
    {
        abort_unless(
            $task->employee_id == Auth::id(),
            403
        );

        return view(
            'employee.tasks.show',
            compact('task')
        );
    }

    /**
     * Submit Task
     */
    public function submit(
        Request $request,
        Task $task
    ) {

        abort_unless(
            $task->employee_id == Auth::id(),
            403
        );

        $request->validate([

            'submitted_file' => [
                'required',
                'file',
                'max:10240'
            ],

            'employee_comment' => [
                'nullable',
                'string'
            ],

        ]);

        $this->taskService->submit(
            $task,
            $request->all()
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Task submitted successfully.'
            );
    }
}
