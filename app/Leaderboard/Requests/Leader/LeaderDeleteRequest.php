<?php

namespace Leaderboard\Requests\Leader;

use Illuminate\Foundation\Http\FormRequest;

class LeaderDeleteRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:leaders,id'
        ];
    }

    public function all($keys = null): array
    {
        $data = parent::all();
        $data['id'] = $this->route('id');
        return $data;
    }

    public function messages():array
    {
        return [
            'id.required' => 'Leader Id is required to delete a record.',
            'id.integer' => 'Leader Id should be an integer.',
            'id.exists' => 'Invalid leader :input of :attribute. No record found.',
        ];
    }
}
