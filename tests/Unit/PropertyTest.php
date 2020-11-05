<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Property;

class PropertyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_if_columns_is_correct()
    {
        $property = new Property;

        $columns_expected = [
            'email_property',
            'street',
            'number',
            'complement',
            'neighborhood',
            'city',
            'state',
            'status'
        ];

        $compare = array_diff($columns_expected, $property->getFillable());

        $this->assertEquals(0, count($compare));
    }
}
