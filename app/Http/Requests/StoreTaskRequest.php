<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreTaskRequest
 *
 * Validates the request data for creating a new task.
 *
 * @package App\Http\Requests
 */
class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'building_id'      => 'required|exists:buildings,id',
            'assigned_user_id' => 'required|exists:users,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'status'           => 'required|in:Open,In Progress,Completed,Rejected',
        ];
    }
}
