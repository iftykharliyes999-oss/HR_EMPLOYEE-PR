<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'required',
                'string',
                'min:10'
            ],

            'employee_id' => [
                'required',
                'exists:users,id'
            ],

            'manager_id' => [
                'nullable',
                'exists:users,id'
            ],

            'priority' => [
                'required',
                'in:Low,Medium,High,Urgent'
            ],

            'status' => [
                'required',
                'in:Pending,In Progress,Completed,Rejected,Overdue'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'due_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png,zip',
                'max:10240'
            ],

            'employee_comment' => [
                'nullable',
                'string'
            ],

            'manager_comment' => [
                'nullable',
                'string'
            ],
        ];
    }

    public function messages(): array
    {
        return [

            'title.required' => 'Task title is required.',

            'employee_id.required' => 'Please select an employee.',

            'due_date.required' => 'Due date is required.',

            'due_date.after_or_equal' => 'Due date must be after start date.',

            'priority.required' => 'Please select task priority.',
        ];
    }
}
