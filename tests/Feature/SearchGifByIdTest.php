<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SearchGifByIdTest extends TestCase
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
    
    public function test_search_gif_by_id()
    {
        $response = $this->get('/api/gifs/MaO10Yn8eWpOGxo9Pn');
        
        $response->assertStatus(200);
    }
    
    public function test_search_gif_by_id_with_invalid_id()
    {
        $response = $this->get('/api/gifs/invalid_id');
        
        $response->assertStatus(400);
    }
    
    public function test_search_gif_not_found()
    {
        $response = $this->get('/api/gifs/dsadasd');
        
        $response->assertStatus(404);
    }
}
