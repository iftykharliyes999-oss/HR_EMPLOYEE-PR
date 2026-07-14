<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Manager's team task list.
     */
    public function index()
    {
        $manager = Auth::user();

        $tasks = Task::with(['employee', 'creator'])
            ->where('manager_id', $manager->id)
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => Task::where('manager_id', $manager->id)->count(),

            'completed' => Task::where('manager_id', $manager->id)
                ->where('status', 'Completed')
                ->count(),

            'pending' => Task::where('manager_id', $manager->id)
                ->where('status', 'Pending')
                ->count(),

            'progress' => Task::where('manager_id', $manager->id)
                ->where('status', 'In Progress')
                ->count(),

            'overdue' => Task::where('manager_id', $manager->id)
                ->where('status', '!=', 'Completed')
                ->whereDate('due_date', '<', today())
                ->count(),
        ];

        return view('manager.tasks.index', compact('tasks', 'stats'));
    }

    /**
     * Show task creation form.
     */
    public function create()
    {
        $manager = Auth::user();

        $employees = User::role('Employee')
            ->where('manager_id', $manager->id)
            ->orderBy('name')
            ->get();

        return view('manager.tasks.create', compact('employees'));
    }

    /**
     * Assign task to own employee.
     */
    public function store(StoreTaskRequest $request)
    {
        $manager = Auth::user();

        $employeeBelongsToManager = User::role('Employee')
            ->where('id', $request->employee_id)
            ->where('manager_id', $manager->id)
            ->exists();

        abort_unless(
            $employeeBelongsToManager,
            403,
            'You can assign tasks only to your own employees.'
        );

        $data = $request->validated();

        $data['manager_id'] = $manager->id;
        $data['status'] = 'Pending';

        $this->taskService->create($data);

        return redirect()
            ->route('manager.tasks.index')
            ->with('success', 'Task assigned successfully.');
    }

    /**
     * Show task details.
     */
    public function show(Task $task)
    {
        abort_unless(
            $task->manager_id === Auth::id(),
            403,
            'You are not authorized to view this task.'
        );

        $task->load(['employee', 'creator']);

        return view('manager.tasks.show', compact('task'));
    }

    /**
     * Employee performance report.
     */
    public function employeeReport(User $employee)
    {
        $manager = Auth::user();

        abort_unless(
            $employee->manager_id === $manager->id
                && $employee->hasRole('Employee'),
            403,
            'This employee is not assigned to you.'
        );

        $tasks = Task::where('manager_id', $manager->id)
            ->where('employee_id', $employee->id)
            ->latest()
            ->get();

        $total = $tasks->count();
        $completed = $tasks->where('status', 'Completed')->count();
        $pending = $tasks->where('status', 'Pending')->count();
        $inProgress = $tasks->where('status', 'In Progress')->count();

        $overdue = $tasks
            ->filter(function (Task $task) {
                return $task->status !== 'Completed'
                    && $task->due_date
                    && $task->due_date->isPast();
            })
            ->count();

        $completionRate = $total > 0
            ? round(($completed / $total) * 100, 1)
            : 0;

        return view('manager.tasks.employee-report', compact(
            'employee',
            'tasks',
            'total',
            'completed',
            'pending',
            'inProgress',
            'overdue',
            'completionRate'
        ));
    }
}
