<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

class InsuredControllerTest extends TestCase
{
    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('insureds.index'));
        $response->assertOk();
        $response->assertViewIs('insureds.index');
    }

    /**
     * Test the create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get(route('insureds.create'));
        $response->assertOk();
        $response->assertViewIs('insureds.create');
    }
}
