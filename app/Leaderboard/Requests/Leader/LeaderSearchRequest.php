<?php

namespace Leaderboard\Requests\Leader;

use Illuminate\Foundation\Http\FormRequest;

class LeaderSearchRequest extends FormRequest
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
            "text" => 'required',
            "column"  => 'required|string'
        ];
    }

    public function all($keys = null): array
    {
        $data = parent::all();
        $data['text'] = $this->route('text');
        $data['column'] = $this->route('column');
        return $data;
    }

    public function messages():array
    {
        return [
            'text:required' => 'Search text is required.',
            'column:required' => 'Searching column name is required.',
            'column:string' => 'Searching column name should be a string.',
        ];
    }
}
