<?php

namespace Leaderboard\Requests\Leader;

use App\Leaderboard\Requests\BaseRequest;

class LeaderUpdateRequest extends BaseRequest
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
            'id' => 'required|integer|exists:leaders,id',
            'name' => 'required|max:255',
            'age' => 'required|numeric|min:0|max:120',
            'points' => 'numeric|min:0|max:2000',
            'address' => 'required|max:200'
        ];
    }

    /**
     * @param $keys
     * @return array
     */
    public function all($keys = null): array
    {
        $data = parent::all();
        $data['id'] = $this->route('id');
        unset($data['_method']);
        return $data;
    }

    /**
     * @return string[]
     */
    public function messages():array
    {
        return [
            'id.required' => 'Leader id is required.',
            'id.integer' => 'Leader id should be an integer.',

            'name.required' => 'Leader name is required.',
            'name.max' => 'Leader name length should be less than :max.',

            'age.required' => 'Leader age is required.',
            'age.numeric' => 'Leader age should be numeric.',
            'age.min' => 'Leader age should not less than :min.',
            'age.max' => 'Leader age should not more than :max.',

            'points.numeric' => 'Leader points should be numeric.',
            'points.min' => 'Leader points should not less than :min.',
            'points.max' => 'Leader points should not more than :max.',

            'address.required' => 'Leader address is required.',
            'address.max' => 'Leader address length should not be more than :max.',
        ];
    }
}
