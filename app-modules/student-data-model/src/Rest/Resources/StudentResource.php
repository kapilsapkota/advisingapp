<?php

namespace AdvisingApp\StudentDataModel\Rest\Resources;

use App\Rest\Resource as RestResource;
use Lomkit\Rest\Http\Requests\RestRequest;
use AdvisingApp\StudentDataModel\Models\Student;

class StudentResource extends RestResource
{
    public static $model = Student::class;

    public function fields(RestRequest $request): array
    {
        return [
            'sisid',
            'full_name',
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
        return [];
    }

    public function scopes(RestRequest $request): array
    {
        return [];
    }
}
