<?php

namespace Tests\Usecases\Insured;

use Tests\TestCase;
use App\Usecases\Insured\Store;
use Illuminate\Http\UploadedFile;

class StoreTest extends TestCase
{
    public function testInvoke()
    {
        $usecase = new Store();
        $file = new UploadedFile(
            public_path('test_data.csv'),
            'test_data.csv',
            'text/csv',
            null,
            true
        );
        $usecase($file);
        $this->assertDatabaseHas('insureds', [
            'name' => '田中太郎'
        ]);
    }
}
