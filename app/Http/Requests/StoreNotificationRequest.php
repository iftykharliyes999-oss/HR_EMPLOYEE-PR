<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'message' => [
                'required',
                'string',
                'min:10'
            ],

            'priority' => [
                'required',
                'in:Normal,Important,Urgent'
            ],

            'audience' => [
                'required',
                'in:All,Managers,Employees'
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:5120'
            ],

            'publish_at' => [
                'nullable',
                'date'
            ],

            'expire_at' => [
                'nullable',
                'date',
                'after_or_equal:publish_at'
            ],

            'status' => [
                'required',
                'in:Draft,Published'
            ],

        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            'title.required' => 'Notification title is required.',

            'message.required' => 'Notification message is required.',

            'priority.required' => 'Please select a priority.',

            'audience.required' => 'Please select an audience.',

            'status.required' => 'Please select notification status.',

            'expire_at.after_or_equal' => 'Expiry date must be after publish date.',

        ];
    }
}
