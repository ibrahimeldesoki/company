<?php

namespace Database\migrations;

use app\Interfaces\DBInterface;

class CreateInvoiceTable implements DBInterface
{

    public function migrate(): string
    {
        return 'CREATE TABLE invoices (
                    `id` int (11) not null primary key AUTO_INCREMENT,
                    `reference_number` varchar(20) not null unique,
                    `start_at` timestamp,
                    `end_at` timestamp,
                    `total_price` int (11) not null,
                    `active_count` int(11) not null,
                    `pending_count` int (11) not null, 
                    `company_id` int (11),
                    FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
                )';
    }
}
