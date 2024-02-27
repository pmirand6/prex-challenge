<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class StoreUserGifTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->artisan('passport:install');
        $this->artisan('passport:keys');
        
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        
        
    }
    
    public function test_store_user_gif(): void
    {
        $response = $this->postJson('/api/user-gifs', [
            'gif_id' => 1,
            'user_id' => 1,
            'alias' => 'alias',
        ]);

        $response->assertStatus(201);
    }
    
    public function test_invalid_user(): void
    {
        $response = $this->postJson('/api/user-gifs', [
            'gif_id' => 1,
            'user_id' => 15156165165,
            'alias' => 'alias',
        ]);
        
        $response->assertStatus(422);
    }
    
    public function test_store_duplicated_gif_id_user_gif(): void
    {
       $this->postJson('/api/user-gifs', [
            'gif_id' => 1,
            'user_id' => 1,
            'alias' => 'alias',
        ]);
        
        $response = $this->postJson('/api/user-gifs', [
            'gif_id' => 1,
            'user_id' => 1,
            'alias' => 'alias',
        ]);
        
        $response->assertStatus(422);
    }
}
