<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Database\Seeders\TestSeeder;
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
    // public function test_profile()
    // {
    // }
    public function test_login()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = User::factory()->create(['name' => '名前', 'email' => 'logintest@example.com', 'password' => bcrypt('password')]);
        $response = $this->post('/login', ['email' => 'logintest@example.com', 'password' => 'password']);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }
    public function test_logout()
    {
        $user = User::inRandomOrder()->first();
        $this->actingAs($user);
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
