<?php

namespace Tests\Usecases\Insured;

use App\Mail\InsuredInformation;
use App\Usecases\Insured\SendEmails;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendEmailsTest extends TestCase
{
    public function testInvoke()
    {
        Mail::fake();

        $usecase = new SendEmails();
        $usecase();
        Mail::assertSent(InsuredInformation::class, function (InsuredInformation $mail) {
            return $mail->hasTo('test@example.com');
        });
    }
}
