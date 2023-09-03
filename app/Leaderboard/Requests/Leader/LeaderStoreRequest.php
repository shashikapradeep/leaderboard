<?php

namespace App\Leaderboard\Requests\Leader;

use Illuminate\Foundation\Http\FormRequest;

class LeaderStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'age' => 'required|numeric|min:0|max:120',
            'points' => 'required|numeric|min:0|max:2000',
            'address' => 'required|max:200'
        ];
    }
}
