<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\Hash;
class UserTest extends TestCase
{
    use RefreshDatabase;
    protected string $seeder = TestSeeder::class;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }
    public function test_profile()
    {
        $response = $this->post('/register', ['name' => '名前', 'email' => 'logintest@example.com', 'password' => 'password']);
        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', [
            'name' => '名前',
            'email' => 'logintest@example.com',
        ]);
        $registered_user = User::find(1);
        $this->assertTrue(Hash::check('password', $registered_user->password));

    }
    public function test_login()
    {
        $user = User::factory()->create(['name' => '名前', 'email' => 'logintest@example.com', 'password' => bcrypt('password')]);
        $response = $this->post('/login', ['email' => 'logintest@example.com', 'password' => 'password']);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }
    public function test_logout()
    {
        $user = User::factory()->create(['name' => '名前', 'email' => 'logouttest@example.com', 'password' => bcrypt('password')]);
        $this->actingAs($user);
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
