<?php

namespace App\Rest\Resources;

use App\Models\User;
use App\Rest\Resource as RestResource;
use Lomkit\Rest\Http\Requests\RestRequest;

class UserResource extends RestResource
{
    public static $model = User::class;

    public function fields(RestRequest $request): array
    {
        return [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ];
    }

    public function relations(RestRequest $request): array
    {
        return [];
    }

    public function scopes(RestRequest $request): array
    {
        return [];
    }
}
