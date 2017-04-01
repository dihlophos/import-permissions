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
     * A basic test example.
     *
     * @return void
     */
    public function testAppAdminAccess()
    {
    	$admin = factory(User::class, 'admin')->make();
    	$admin->save();
    	
    	$this->actingAs($admin);

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
}
