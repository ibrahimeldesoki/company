<?php

namespace App\controllers;

use App\core\Controller;
use App\models\Subscriber as SubscriberModel;
use App\Requests\CompanySubscriberRequest;
use App\Utilities\StatusUtil;


class Subscriber extends Controller
{
    private SubscriberModel $subscriberModel;

    public function __construct()
    {
        $this->subscriberModel = $this->model('Subscriber');
    }

    public function company(): void
    {
        $request = $_POST;
        $validationErrors = CompanySubscriberRequest::validateRequest($request);
        if (!empty($validationErrors['errors'])) {
            echo json_encode($validationErrors);
            die();
        }
        $isSubscriber = $this->subscriberModel->checkUserSubscriptionAtCompany($request);
        if ($isSubscriber)
        {
            echo json_encode(['message' => 'Already Subscriber at your company']);
            die();
        }
        $isPendingSubscriber = $this->subscriberModel->isSubscriber($request['user_id'], StatusUtil::PENDING->value);
        if ($isPendingSubscriber)
        {
            $subscriber = $this->subscriberModel->update($request);
            if ($subscriber)
            {
                echo json_encode("subscriber added with pending status");
                die();
            }
        }
        $isActiveSubscriber = $this->subscriberModel->isSubscriber($request['user_id'], StatusUtil::ACTIVE->value);
        if ($isActiveSubscriber)
        {
                echo json_encode("not Allowed");
                die();
        }
        $subscriber = $this->subscriberModel->create($request);

        if ($subscriber !== true) {
            echo json_encode(['errors' => $subscriber]);
            die();
        }

        echo json_encode("subscriber added with pending status");
        die();
    }
}