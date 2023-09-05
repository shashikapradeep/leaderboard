<?php

namespace App\Leaderboard\Requests;

use Leaderboard\Requests\BaseRequestTrait;
use Leaderboard\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    use BaseRequestTrait, HttpResponse;

    /**
     * Overriding the request failed response
     *
     * @param Validator $validator
     */

    private $default_error = 'One or more fields have an error. Please check and try again.';

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->sendErrorResponse(["errors" => $validator->errors()], $this->default_error, 422)
        );
    }
}
