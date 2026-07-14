<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    /**
     * Create Task
     */
    public function create(array $data): Task
    {
        // Attachment Upload
        if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {

            $file = $data['attachment'];

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/tasks'), $filename);

            $data['attachment'] = 'uploads/tasks/' . $filename;
        }

        $data['created_by'] = Auth::id();

        return Task::create($data);
    }

    /**
     * Update Task
     */
    public function update(Task $task, array $data): Task
    {
        if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {

            if ($task->attachment && file_exists(public_path($task->attachment))) {
                unlink(public_path($task->attachment));
            }

            $file = $data['attachment'];

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/tasks'), $filename);

            $data['attachment'] = 'uploads/tasks/' . $filename;
        }

        $task->update($data);

        return $task;
    }

    /**
     * Employee Submit Task
     */
    public function submit(Task $task, array $data): Task
    {
        if (isset($data['submitted_file']) && $data['submitted_file'] instanceof UploadedFile) {

            $file = $data['submitted_file'];

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/task-submissions'), $filename);

            $task->submitted_file = 'uploads/task-submissions/' . $filename;
        }

        $task->employee_comment = $data['employee_comment'] ?? null;

        $task->status = 'Completed';

        $task->submitted_at = now();

        $task->completed_at = now();

        $task->save();

        return $task;
    }

    /**
     * Delete Task
     */
    public function delete(Task $task): void
    {
        if ($task->attachment && file_exists(public_path($task->attachment))) {
            unlink(public_path($task->attachment));
        }

        if ($task->submitted_file && file_exists(public_path($task->submitted_file))) {
            unlink(public_path($task->submitted_file));
        }

        $task->delete();
    }
}
