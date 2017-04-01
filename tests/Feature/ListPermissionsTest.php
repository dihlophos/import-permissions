<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\URL;


class ListPermissionsTest extends TestCase
{
	use DatabaseTransactions;
    /**
     * Test appadmin access to lists.
     *
     * @return void
     */
    public function testAppAdminAccess()
    {
    	$user = factory(User::class, 'appadmin')->make();
    	$user->save();
    	
    	$this->actingAs($user);

    	$this->get(URL::route('lists-index'))
            ->assertStatus(200);

        $this->get(URL::route('user.index'))
            ->assertStatus(200);

        $this->get(URL::route('organization.index'))
            ->assertStatus(200);

        $this->get(URL::route('region.index'))
            ->assertStatus(200);

        $this->get(URL::route('transport.index'))
            ->assertStatus(200);

        $this->get(URL::route('purpose.index'))
            ->assertStatus(200);

        $this->get(URL::route('product_type.index'))
            ->assertStatus(200);

        $this->get(URL::route('storage.index'))
            ->assertStatus(200);

        $this->get(URL::route('institution.index'))
            ->assertStatus(200);

    }

    /**
     * Test depadmin access to lists.
     *
     * @return void
     */
    public function testDepAdminAccess()
    {
    	$user = factory(User::class, 'depadmin')->make();
    	$user->save();
    	
    	$this->actingAs($user);

    	$this->get(URL::route('lists-index'))
            ->assertStatus(403);

        $this->get(URL::route('user.index'))
            ->assertStatus(403);

        $this->get(URL::route('organization.index'))
            ->assertStatus(403);

        $this->get(URL::route('region.index'))
            ->assertStatus(403);

        $this->get(URL::route('transport.index'))
            ->assertStatus(403);

        $this->get(URL::route('purpose.index'))
            ->assertStatus(403);

        $this->get(URL::route('product_type.index'))
            ->assertStatus(403);

        $this->get(URL::route('storage.index'))
            ->assertStatus(403);

        $this->get(URL::route('institution.index'))
            ->assertStatus(403);

    }

    /**
     * Test instadmin access to lists.
     *
     * @return void
     */
    public function testInstAdminAccess()
    {
    	$user = factory(User::class, 'instadmin')->make();
    	$user->save();
    	
    	$this->actingAs($user);

    	$this->get(URL::route('lists-index'))
            ->assertStatus(403);

        $this->get(URL::route('user.index'))
            ->assertStatus(403);

        $this->get(URL::route('organization.index'))
            ->assertStatus(403);

        $this->get(URL::route('region.index'))
            ->assertStatus(403);

        $this->get(URL::route('transport.index'))
            ->assertStatus(403);

        $this->get(URL::route('purpose.index'))
            ->assertStatus(403);

        $this->get(URL::route('product_type.index'))
            ->assertStatus(403);

        $this->get(URL::route('storage.index'))
            ->assertStatus(403);

        $this->get(URL::route('institution.index'))
            ->assertStatus(403);

    }

    /**
     * Test instspec access to lists.
     *
     * @return void
     */
    public function testInstSpecAccess()
    {
    	$user = factory(User::class, 'instspec')->make();
    	$user->save();
    	
    	$this->actingAs($user);

    	$this->get(URL::route('lists-index'))
            ->assertStatus(403);

        $this->get(URL::route('user.index'))
            ->assertStatus(403);

        $this->get(URL::route('organization.index'))
            ->assertStatus(403);

        $this->get(URL::route('region.index'))
            ->assertStatus(403);

        $this->get(URL::route('transport.index'))
            ->assertStatus(403);

        $this->get(URL::route('purpose.index'))
            ->assertStatus(403);

        $this->get(URL::route('product_type.index'))
            ->assertStatus(403);

        $this->get(URL::route('storage.index'))
            ->assertStatus(403);

        $this->get(URL::route('institution.index'))
            ->assertStatus(403);

    }
}
