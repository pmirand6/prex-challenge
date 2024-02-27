<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/27 10:55
 */

namespace Tests\Unit\AuditTrailRepository;

use App\Dtos\Audit\StoreAuditDto;
use App\Models\User;
use App\Repositories\AuditTrailRepository;
use App\Repositories\Contracts\IAuditTrailRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

class AuditTrailRepositoryTest extends TestCase
{
    Use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
    }
    
    private function getRepositoryInstance(): IAuditTrailRepository
    {
        return $this->app->make(AuditTrailRepository::class);
    }
    
    public function test_can_instantiate_repository()
    {
        $repository = $this->getRepositoryInstance();
        $this->assertInstanceOf(AuditTrailRepository::class, $repository);
    }
    
    public function test_store_audit(): void
    {
        $repository = $this->getRepositoryInstance();
        $user = User::factory()->create();
        $dto = new StoreAuditDto(
            url: 'testUrl',
            requestBody: ['test' => 'test'],
            response: 'testResponse',
            clientIpAddress: 'testIp',
            userId: $user->id
        );
        $result = $repository->storeAudit($dto);
        $this->assertNotNull($result);
        $this->assertIsInt($result->id);
        $this->assertEquals('testUrl', $result->url);
        $this->assertEquals('{"test":"test"}', $result->request_body);
        $this->assertEquals('testResponse', $result->response);
        $this->assertEquals('testIp', $result->client_ip_address);
        $this->assertEquals($user->id, $result->user_id);
    }
    
    public function test_store_audit_exception(): void
    {
        $this->expectException(Throwable::class);
        $repository = $this->getRepositoryInstance();
        $dto = new StoreAuditDto(
            url: 'testUrl',
            requestBody: ['test' => 'test'],
            response: 'testResponse',
            clientIpAddress: 'testIp',
            userId: 24
        );
        $result = $repository->storeAudit($dto);
        $this->assertNull($result);
    }
    
}