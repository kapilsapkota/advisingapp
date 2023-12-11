<?php

namespace AdvisingApp\Notifications\Rest\Resources;

use App\Models\User;
use App\Rest\Resources\UserResource;
use Illuminate\Validation\Rule;
use Lomkit\Rest\Relations\BelongsTo;
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
            // 'user_id',
            // 'subscribable_id',
            // 'subscribable_type',
            'created_at',
            'updated_at',
        ];
    }

    public function createRules(RestRequest $request): array
    {
        return [
            'id' => ['missing'],
            'created_at' => ['missing'],
            'updated_at' => ['missing'],
        ];
    }

    public function updateRules(RestRequest $request): array
    {
        return [];
    }

    public function relations(RestRequest $request): array
    {
        return [
            BelongsTo::make('user', UserResource::class)
                ->requiredOnCreation(),
            MorphTo::make('subscribable', [
                // ProspectResource::class,
                StudentResource::class,
            ])->requiredOnCreation(),
        ];
    }

    public function scopes(RestRequest $request): array
    {
        return [];
    }
}
