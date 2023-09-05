<?php

namespace Leaderboard\Requests\Leader;

use App\Leaderboard\Requests\BaseRequest;

class LeaderOneRequest extends BaseRequest
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
            'id' => 'required|integer'
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
            'id.required' => 'Leader Id is required to fetch a record.',
            'id.string' => 'Leader Id should be an integer.',
            'id.exists' => 'Invalid leader :input of :attribute.',
        ];
    }
}
