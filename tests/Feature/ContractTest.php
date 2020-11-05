<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Contract;

class ContractTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function check_can_read_the_contract_list()
    {
        $contract = factory(Contract::class)->create();

        $response = $this->get('/api/contracts');

        $response->assertStatus(200)
            ->assertSee($contract->email_contract)
            ->assertSee($contract->type_person)
            ->assertSee($contract->name)
            ->assertSee($contract->property_id)
            ->assertSee($contract->document)
            ->assertSee($contract->uuid)
            ;
    }

    /** @test */
    public function contract_requires_a_email_contract()
    {
        $contract = factory(Contract::class)->make(['email_contract' => null]);

        $this->post('/api/contract/store',$contract->toArray())
                ->assertSessionHasErrors('email_contract');
    }

    /** @test */
    public function contract_requires_a_type_person()
    {
        $contract = factory(Contract::class)->make(['type_person' => null]);

        $this->post('/api/contract/store',$contract->toArray())
                ->assertSessionHasErrors('type_person');
    }

    /** @test */
    public function contract_requires_a_name()
    {
        $contract = factory(Contract::class)->make(['name' => null]);

        $this->post('/api/contract/store',$contract->toArray())
                ->assertSessionHasErrors('name');
    }

    /** @test */
    public function contract_requires_a_property_id()
    {
        $contract = factory(Contract::class)->make(['property_id' => null]);

        $this->post('/api/contract/store',$contract->toArray())
                ->assertSessionHasErrors('property_id');
    }

    /** @test */
    public function contract_requires_a_document()
    {
        $contract = factory(Contract::class)->make(['document' => null]);

        $this->post('/api/contract/store',$contract->toArray())
                ->assertSessionHasErrors('document');
    }

    /** @test */
    public function check_if_update_contract_works()
    {
        $contract = factory(Contract::class)->create();
        $contract->name = "Updated name";
        $this->put('/api/contract/update/'.$contract->id, $contract->toArray());
        $this->assertDatabaseHas('contract',['id'=> $contract->id , 'name' => 'Updated name']);
    }

    /** @test */
    public function check_if_destroy_contract_works()
    {
        $contract = factory(Contract::class)->create();
        
        $this->delete('/api/contract/delete/'.$contract->id);
        $this->assertDatabaseMissing('contract',['id'=> $contract->id]);
    }
}
