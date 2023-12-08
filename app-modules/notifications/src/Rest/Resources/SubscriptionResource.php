<?php

namespace AdvisingApp\Notifications\Rest\Resources;

use Lomkit\Rest\Relations\MorphTo;
use App\Rest\Resource as RestResource;
use Lomkit\Rest\Http\Requests\RestRequest;
use AdvisingApp\Notifications\Models\Subscription;
use AdvisingApp\Prospect\Rest\Resources\ProspectResource;
use AdvisingApp\StudentDataModel\Rest\Resources\StudentResource;

class SubscriptionResource extends RestResource
{
    public static $model = Subscription::class;

    public function fields(RestRequest $request): array
    {
        return [
            'id',
            'user_id', //TODO: should be User relation when we have a user api
            'subscribable_id',
            'subscribable_type',
            'created_at',
            'updated_at',
        ];
    }

    public function createRules(RestRequest $request): array
    {
        return [];
    }

    public function updateRules(RestRequest $request): array
    {
        return [];
    }

    public function relations(RestRequest $request): array
    {
        return [
            MorphTo::make('subscribable', [
                ProspectResource::class,
                StudentResource::class,
            ]),
        ];
    }

    public function scopes(RestRequest $request): array
    {
        return [];
    }
}
