<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contract;

class ContractTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_if_contract_columns_is_correct()
    {
        $contract = new Contract;

        $columns_expected = [
            'type_person', 
            'name', 
            'email_contract', 
            'property_id', 
            'document',
            'uuid'
        ];

        $compare = array_diff($columns_expected, $contract->getFillable());

        $this->assertEquals(0, count($compare));
    }
}
