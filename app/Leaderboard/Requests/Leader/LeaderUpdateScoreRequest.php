<?php

namespace Leaderboard\Requests\Leader;

use Illuminate\Foundation\Http\FormRequest;

class LeaderUpdateScoreRequest extends FormRequest
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
            "id" => 'required|integer|exists:leaders,id',
            "context"  => 'required|string'
        ];
    }

    public function all($keys = null): array
    {
        $data = parent::all();
        $data['id'] = $this->route('id');
        $data['context'] = $this->route('context');
        return $data;
    }

    public function messages():array
    {
        return [
            'id:required' => 'Leader id is required.',
            'id:integer' => 'Leader id should be a integer.',
            'context:string' => 'Context field should be a string.',
        ];
    }
}
