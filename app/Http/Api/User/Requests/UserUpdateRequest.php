<?php

namespace App\Http\Api\User\Requests;

use App\Http\Api\ApiRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends ApiRequest
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
                Rule::unique('users', 'email')->ignore($this->user->id, 'id')
            ]
        ];
    }
}
