<?php

namespace app\Utilities;

class InvoiceUtil
{
    public const SubscriberPrice = 25;

    public static function generateReferenceNumber(): string
    {
        return uniqid('invoice') . rand(1, 10_000);
    }

    public static function getInvoiceData(int $companyId, $count): array
    {
        $data['reference_number'] = self::generateReferenceNumber();
        $data['company_id'] = $companyId;
        $today = new \DateTime();

        $data['start_at'] = $today->format('Y-m-d');
        $data['end_at'] = $today->modify('+1 month')->format('Y-m-d');
        $data['subscriber_price'] = self::SubscriberPrice; // معا ضد الغلاء 🤏

        $data['pending_count'] = $count['pending'] ?? [];
        $data['active_count'] = $count['active'] ?? [];
        $data['total_price'] = ($data['pending_count'] + $data['active_count']) * $data['subscriber_price'];

        return $data;
    }
}