<?php

namespace App\Http\Api\User\Requests;

use App\Http\Api\ApiRequest;

class UserQueryRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'draw' => 'nullable|integer',
            'start' => 'nullable|integer',
            'length' => 'nullable|integer',
            'search' => 'nullable|array',
            'order' => 'nullable|array',
            'columns' => 'nullable|array',
        ];
    }
}
                