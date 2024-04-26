<?php

namespace Tests\Usecases\Insured;

use App\Usecases\Insured\Search;
use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testInvoke()
    {
        $usecase = new Search();
        $insureds = $usecase(['name' => 'Test Insured']);
        $this->assertEquals('Test Insured', $insureds[0]->name);
    }
}
