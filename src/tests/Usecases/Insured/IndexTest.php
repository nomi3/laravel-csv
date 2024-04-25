<?php

namespace Tests\Usecases\Insured;

use App\Usecases\Insured\Index;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function testInvoke()
    {
        $usecase = new Index();
        $insureds = $usecase();
        $this->assertEquals('Test Insured', $insureds[0]->name);
    }
}
