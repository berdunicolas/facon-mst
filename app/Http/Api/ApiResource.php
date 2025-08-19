<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    public function __construct(
        mixed $data,
        private string $dataResource,
    )
    {
        parent::__construct($data);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'actions' => [
                'url' => route('api.users.show', $this->id),
                'can_edit' => true,
                'can_delete' => true,
            ]
        ];
    }
}
