<?php

namespace app\models;

use app\Utilities\StatusUtil;

class Subscriber extends BaseModel
{
//    private StatusUtil $status = StatusUtil::PENDING;

    public function create(array $data): string|bool
    {
        var_dump(StatusUtil::PENDING);
        $create = 'INSERT INTO subscribers (user_id, company_id, status) values (:user_id, :company_id, :status)';

        try {
            $this->pdo->prepare($create)->execute([
                ':user_id' => $data['user_id'],
                ':company_id' => $data['company_id'],
                ':status' => StatusUtil::PENDING->value,
            ]);

        } catch (\PDOException $exception) {
            return 'invalid request data';
        }

        return true;
    }
}