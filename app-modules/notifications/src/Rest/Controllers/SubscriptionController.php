<?php

namespace AdvisingApp\Notifications\Rest\Controllers;

use AdvisingApp\Notifications\Rest\Resources\SubscriptionResource;
use App\Rest\Controller as RestController;

class SubscriptionController extends RestController
{
    public static $resource = SubscriptionResource::class;
}
