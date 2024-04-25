<?php

namespace App\Usecases\Insured;

use App\Models\Insured;

class Index
{
    public function __invoke()
    {
        return Insured::all();
    }
}
