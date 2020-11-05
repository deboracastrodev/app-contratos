<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Property;

class PropertyTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function check_can_read_the_property_list()
    {
        $property = factory(Property::class)->create();

        $response = $this->get('/api/properties');

        $response->assertStatus(200)
            ->assertSee($property->email_property)
            ->assertSee($property->street)
            ->assertSee($property->number)
            ->assertSee($property->complement)
            ->assertSee($property->neighborhood)
            ->assertSee($property->city)
            ->assertSee($property->state)
            ->assertSee($property->status)
            ;
    }

    /** @test */
    public function property_requires_a_email_property()
    {
        $property = factory(Property::class)->make(['email_property' => null]);

        $this->post('/api/property/store',$property->toArray())
                ->assertSessionHasErrors('email_property');
    }

    /** @test */
    public function property_requires_a_street()
    {
        $property = factory(Property::class)->make(['street' => null]);

        $this->post('/api/property/store',$property->toArray())
                ->assertSessionHasErrors('street');
    }

    /** @test */
    public function property_requires_a_neighborhood()
    {
        $property = factory(Property::class)->make(['neighborhood' => null]);

        $this->post('/api/property/store',$property->toArray())
                ->assertSessionHasErrors('neighborhood');
    }

    /** @test */
    public function property_requires_a_city()
    {
        $property = factory(Property::class)->make(['city' => null]);

        $this->post('/api/property/store',$property->toArray())
                ->assertSessionHasErrors('city');
    }

    /** @test */
    public function property_requires_a_state()
    {
        $property = factory(Property::class)->make(['state' => null]);

        $this->post('/api/property/store',$property->toArray())
                ->assertSessionHasErrors('state');
    }

    /** @test */
    public function check_if_update_property_works()
    {
        $property = factory(Property::class)->create();
        $property->street = "Updated street";
        $this->put('/api/property/update/'.$property->id, $property->toArray());
        $this->assertDatabaseHas('property',['id'=> $property->id , 'street' => 'Updated street']);
    }

    /** @test */
    public function check_if_destroy_property_works()
    {
        $property = factory(Property::class)->create();

        $contract = factory('App\Contract')->create()->make(['property_id', $property->id]);

        $this->delete('/api/property/delete/'.$property->id);
        //valida se excluí o contrato vinculado
        $this->assertDatabaseMissing('contract',['id'=> $contract->id]);
        //valida excluão logica da propriedade
        $this->assertDatabaseHas('property',['deleted_at'=> $property->deleted_at]);

    }
}
