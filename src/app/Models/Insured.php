<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'insurance_card_number',
        'email',
    ];
}
