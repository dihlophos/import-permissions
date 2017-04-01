<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\URL;
use App\Models\Institution;
use App\Models\User;

class ExportListAccessTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Test appadmin access to exports list.
     *
     * @return void
     */
    public function testAppAdminAccess()
    {
    	$user = factory(User::class, 'appadmin')->make();
    	$user->save();

    	$institution = factory(Institution::class)->make();
    	$institution->save();
    	
    	$this->actingAs($user);

    	$this->get(URL::route('export.index', ['institution'=>$institution->id]))
            ->assertStatus(200);
    }

    /**
     * Test depadmin access to exports list.
     *
     * @return void
     */
    public function testDepAdminAccess()
    {
    	$user = factory(User::class, 'depadmin')->make();
    	$user->save();

    	$institution = factory(Institution::class)->make();
    	$institution->save();
    	
    	$this->actingAs($user);

    	$this->get(URL::route('export.index', ['institution'=>$institution->id]))
            ->assertStatus(200);
    }

    /**
     * Test instadmin access to exports list of his institution.
     *
     * @return void
     */
    public function testInstAdminAccessSameInst()
    {
    	$institution = factory(Institution::class)->make();
    	$institution->save();

    	$user = factory(User::class, 'instadmin')->make();
    	$user->institution()->associate($institution);
    	$user->save();    	
    	
    	$this->actingAs($user);

    	$this->get(URL::route('export.index', ['institution'=>$institution->id]))
            ->assertStatus(200);
    }

    /**
     * Test instadmin access to exports list of another institution.
     *
     * @return void
     */
    public function testInstAdminAccessForeignInst()
    {
    	$institution = factory(Institution::class)->make();
    	$institution->save(); 

    	$user = factory(User::class, 'instadmin')->make();
    	$user->institution()->associate($institution);
    	$user->save();    	
    	
    	$another_institution = factory(Institution::class)->make();
    	$another_institution->save();

    	$this->actingAs($user);

    	$this->get(URL::route('export.index', ['institution'=>$another_institution->id]))
            ->assertStatus(403);
    }

    /**
     * Test instspec access to exports list of his institution.
     *
     * @return void
     */
    public function testInstSpecAccessSameInst()
    {
    	$institution = factory(Institution::class)->make();
    	$institution->save();

    	$user = factory(User::class, 'instspec')->make();
    	$user->institution()->associate($institution);
    	$user->save();    	
    	
    	$this->actingAs($user);

    	$this->get(URL::route('export.index', ['institution'=>$institution->id]))
            ->assertStatus(200);
    }

    /**
     * Test instspec access to exports list of another institution.
     *
     * @return void
     */
    public function testInstSpecAccessForeignInst()
    {
    	$institution = factory(Institution::class)->make();
    	$institution->save(); 

    	$user = factory(User::class, 'instspec')->make();
    	$user->institution()->associate($institution);
    	$user->save();    	
    	
    	$another_institution = factory(Institution::class)->make();
    	$another_institution->save();

    	$this->actingAs($user);

    	$this->get(URL::route('export.index', ['institution'=>$another_institution->id]))
            ->assertStatus(403);
    }
}
