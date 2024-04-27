<?php

use App\Usecases\Insured\SendEmails;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('insured:send-email', function (SendEmails $usecase) {
    $usecase();
})->purpose('Send email to insureds')->dailyAt('10:00');
