<?php

namespace App\Http\Api\User\Requests;

use App\Http\Api\ApiRequest;

class UserStoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'unique:users,email'
            ]
        ];
    }
}
