<?php

namespace App\models;

use App\Utilities\StatusUtil;

class Subscriber extends BaseModel
{
    public function create(array $data): string|bool
    {
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

    public function checkUserSubscriptionAtCompany(array $data)
    {
        $selectSubscriber = 'SELECT * FROM subscribers where 1=1 AND 
                                `user_id`=:user_id 
                                AND 
                                `company_id`=:company_id
                              ';
        $subscriber = $this->pdo->prepare($selectSubscriber);
        $subscriber->execute([
            ':user_id' => $data['user_id'],
            ':company_id' => $data['company_id']
        ]);

        return $subscriber->fetch();
    }

    public function isSubscriber(int $userId, string $status)
    {
        $selectSubscriber = 'SELECT * FROM subscribers where 1=1 AND 
                                `user_id`=:user_id 
                                AND 
                                `status`=:status
                              ';
        $subscriber = $this->pdo->prepare($selectSubscriber);
        $subscriber->execute([
            ':user_id' => $userId,
            ':status' => $status,
        ]);

        return $subscriber->fetch();
    }

    public function update(array $data)
    {
        $update = 'UPDATE subscribers SET `company_id`=:company_id where 1=1
                        AND `user_id`=:user_id
                    ';
        return $this->pdo->prepare($update)->execute([
            ':company_id' => $data['company_id'],
            ':user_id' => $data['user_id']
        ]);
    }

    public function getCompanyActiveAndPendingCount(int $companyId) :array
    {
        $query = 'SELECT status,count(*) AS count from subscribers where 1=1 
                                AND  `company_id`=:company_id
                                AND `status` <> :status
                                group by status
                               ';

        $count = $this->pdo->prepare($query);
        $count->execute([
            ':company_id' => $companyId,
            ':status' => StatusUtil::IN_ACTIVE->value
        ]);

        $rows = $count->fetchAll(\PDO::FETCH_ASSOC);
        $groupedRows = [];
        foreach ($rows as $row){
            $groupedRows[$row['status']] = $row['count'];

        }

        return $groupedRows;
    }
}