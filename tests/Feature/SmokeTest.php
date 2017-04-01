<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Basic access test.
     *
     * @return void
     */
    public function testBasicAccess()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /**
     * Admin authorize test.
     *
     * @return void
     */
    public function testAppAdminAuthorize()
    {
        $user = factory(User::class, 'appadmin')->make();
        $user->save();
        $this->actingAs($user);

        $response = $this->get('/home');
        $response->assertStatus(200);
    }

    /**
     * No authorize test.
     *
     * @return void
     */
    public function testNoAuthorize()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }
}
