<?php

namespace Database\migrations;

use App\Interfaces\DBInterface;

class addDateAtCompaniesTable implements DBInterface
{

    public function migrate() :string
    {
        return "ALTER TABLE companies ADD  COLUMN  start_at timestamp,
                    ADD COLUMN end_at timestamp after start_at";
    }
}