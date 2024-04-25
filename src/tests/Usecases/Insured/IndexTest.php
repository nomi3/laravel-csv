<?php

namespace Tests\Usecases\Insured;

use Tests\TestCase;
use App\Usecases\Insured\Index;

class IndexTest extends TestCase
{
    public function testInvoke()
    {
        $usecase = new Index();
        $insureds = $usecase();
        $this->assertEquals('Test Insured', $insureds[0]->name);
    }
}


