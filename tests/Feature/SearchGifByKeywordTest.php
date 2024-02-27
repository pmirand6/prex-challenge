<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SearchGifByKeywordTest extends TestCase
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
    public function test_search_gif_by_keyword()
    {
        
        $response = $this->get('/api/gifs/search?query=test&limit=5&offset=0');
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'meta',
                'pagination'
            ]);
    }
    
    public function test_failed_validation()
    {
        $response = $this->get('/api/gifs/search');
        
        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
        
    }
    
}
