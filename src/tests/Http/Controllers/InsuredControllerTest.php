<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;

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

    /**
     * Test the store method.
     *
     * @return void
     */
    public function testStore()
    {
        $file = new UploadedFile(
            public_path('test_data.csv'),
            'test_data.csv',
            'text/csv',
            null,
            true
        );
        $this->post(route('insureds.store'),[
            'csv_file' => $file
        ]);
        $this->assertDatabaseHas('insureds', [
            'name' => '田中太郎'
        ]);
    }
}
