<?php

namespace Leaderboard\Requests\Leader;

use App\Leaderboard\Requests\BaseRequest;

class LeaderAllRequest extends BaseRequest
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
            "orderBy" => 'string',
            "sortBy"  => 'string|in:desc,asc'
        ];
    }

    public function all($keys = null): array
    {
        $data = parent::all();
        $data['orderBy'] = $this->route('orderBy');
        $data['sortBy'] = $this->route('sortBy');
        return $data;
    }

    public function messages():array
    {
        return [
            'orderBy:string' => 'Order by field should be a string.',
            'sortBy:string' => 'Sort by field should be a string.',
            'sortBy:in' => 'Sort by field should be either "desc" or "asc".',
        ];
    }
}
