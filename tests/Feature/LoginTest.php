<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->artisan('passport:install');
        $this->artisan('passport:keys');
        
        User::factory()->create([
            'email' => 'test@prex-challenge.com',
            'password' => bcrypt('password'),
        ]);
        
        
    }
    
    public function test_login_success()
    {
        $response = $this->post('/api/login', [
            'email' => 'test@prex-challenge.com',
            'password' => 'password',
        ]);
        
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'access_token',
            'expires_at',
        ]);
    }
    
    public function test_login_failure()
    {
        $response = $this->post('/api/login', [
            'email' => 'test@prex-challenge.com',
            'password' => 'wrong - password',
        ]);
        
        $response->assertStatus(401);
    }
    
    public function test_invalid_fields()
    {
        $response = $this->post('/api/login', []);
        
        $response->assertStatus(422);
        
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
                'password',
            ],
        ]);
        
    }
    
    public function test_expiration_token_in_30_minutes_from_now()
    {
        $response = $this->post('/api/login', [
            'email' => 'test@prex-challenge.com',
            'password' => 'password',
        ]);
        
        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'access_token',
            'expires_at',
        ]);
        
        $expiresAt = $response->json('expires_at');
        $expirationTimestamp = Carbon::parse($expiresAt)->timestamp;
        $nowTimestamp = now()->timestamp;
        
        $differenceInSeconds = $expirationTimestamp - $nowTimestamp;
        $this->assertLessThanOrEqual(30 * 60, $differenceInSeconds);
    }
    
    
}
