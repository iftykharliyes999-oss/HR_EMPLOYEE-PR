<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Task List
     */
    public function index()
    {
        $tasks = Task::with([
                'employee',
                'manager',
                'creator'
            ])
            ->latest()
            ->paginate(10);

        $stats = [

            'total' => Task::count(),

            'completed' => Task::where('status', 'Completed')->count(),

            'pending' => Task::where('status', 'Pending')->count(),

            'progress' => Task::where('status', 'In Progress')->count(),

            'overdue' => Task::where('status', 'Overdue')->count(),

        ];

        return view(
            'admin.tasks.index',
            compact(
                'tasks',
                'stats'
            )
        );
    }

    /**
     * Create Page
     */
    public function create()
    {
        $employees = User::role('Employee')
            ->orderBy('name')
            ->get();

        $managers = User::role('Manager')
            ->orderBy('name')
            ->get();

        return view(
            'admin.tasks.create',
            compact(
                'employees',
                'managers'
            )
        );
    }

    /**
     * Store
     */
    public function store(StoreTaskRequest $request)
    {
        $this->taskService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.tasks.index')
            ->with(
                'success',
                'Task assigned successfully.'
            );
    }

    /**
     * Details
     */
    public function show(Task $task)
    {
        $task->load([
            'employee',
            'manager',
            'creator'
        ]);

        return view(
            'admin.tasks.show',
            compact('task')
        );
    }


        /**
     * Edit Page
     */
    public function edit(Task $task)
    {
        $employees = User::role('Employee')
            ->orderBy('name')
            ->get();

        $managers = User::role('Manager')
            ->orderBy('name')
            ->get();

        return view(
            'admin.tasks.edit',
            compact(
                'task',
                'employees',
                'managers'
            )
        );
    }

    /**
     * Update Task
     */
    public function update(
        UpdateTaskRequest $request,
        Task $task
    ) {

        $this->taskService->update(
            $task,
            $request->validated()
        );

        return redirect()
            ->route('admin.tasks.index')
            ->with(
                'success',
                'Task updated successfully.'
            );

    }

    /**
     * Delete Task
     */
    public function destroy(Task $task)
    {

        $this->taskService->delete($task);

        return redirect()
            ->route('admin.tasks.index')
            ->with(
                'success',
                'Task deleted successfully.'
            );

    }
}


