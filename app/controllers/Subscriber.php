<?php

namespace app\controllers;

use app\core\Controller;
use app\Requests\CompanySubscriberRequest;

class Subscriber extends Controller
{
    private $subscriberModel;

    public function __construct()
    {
        $this->subscriberModel = $this->model('Subscriber');
    }

    public function company()
    {
        $request = $_POST;
        $validationErrors = CompanySubscriberRequest::validateRequest($request);
        if (!empty($validationErrors['errors'])) {
            echo json_encode($validationErrors);
            die();
        }

        $subscriber = $this->subscriberModel->create($request);

        if ($subscriber !== true) {
            echo json_encode(['errors' => $subscriber]);
        }

        echo json_encode("subscriber added with pending status");
        die();
    }
}