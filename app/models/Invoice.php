<?php

namespace app\models;

use app\models\Subscriber as SubscriberModel;

class Invoice extends BaseModel
{
    public function getCompanyActiveAndPendingCount(int $companyId): array
    {
        $companyModel = new SubscriberModel();
        return $companyModel->getCompanyActiveAndPendingCount($companyId);
    }
    public function create(array $data)
    {
        $create = 'INSERT INTO invoices
            (reference_number, start_at, end_at, company_id, total_price, active_count, pending_count) 
            values 
            (:reference_number, :start_at, :end_at, :company_id, :total_price, :active_count, :pending_count)';
        try {
            $this->pdo->prepare($create)->execute(
                [
                    ':reference_number' => $data['reference_number'],
                    ':start_at' => $data['start_at'],
                    ':end_at' => $data['end_at'],
                    ':company_id' => $data['company_id'],
                    ':total_price' => $data['total_price'],
                    ':active_count' => $data['active_count'],
                    ':pending_count' => $data['pending_count']
                ]);
        } catch (\PDOException $exception) {
            return 'invalid request data';
        }

        return true;
    }
}