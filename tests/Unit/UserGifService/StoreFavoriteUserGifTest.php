<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 21:51
 */

namespace Tests\Unit\UserGifService;

use App\Dtos\UserGifs\StoreUserGifDto;
use App\Exceptions\UserGifServiceException;
use App\Models\User;
use App\Models\UserGifs;
use App\Repositories\Contracts\IUserGifRepository;
use App\Services\UserGifService;
use Mockery;
use Tests\TestCase;

class StoreFavoriteUserGifTest extends TestCase
{
    
    public function setUp(): void
    {
        parent::setUp();
        $this->mockUserGifRepository = Mockery::mock(IUserGifRepository::class);
    }
    
    public function getUserGifService(): UserGifService
    {
        return new UserGifService($this->mockUserGifRepository);
    }
    
    public function test_can_instantiate_service()
    {
        $service = $this->getUserGifService();
        $this->assertInstanceOf(UserGifService::class, $service);
    }
    
    public function test_can_store_a_users_favorite_gif()
    {
        $storeUserGifDto = new StoreUserGifDto(
            userId: 1,
            gifId: 1,
            alias: 'My favorite gif'
        );
        
        $this->mockUserGifRepository
            ->shouldReceive('storeGif')
            ->with($storeUserGifDto)
            ->andReturn(new UserGifs());
        
        $service = $this->getUserGifService();
        $userGif = $service->storeFavoriteGif($storeUserGifDto);
        
        $this->assertInstanceOf(UserGifs::class, $userGif);
        
    }
    
    public function test_cannot_store_a_users_favorite_gif()
    {
        $this->expectException(UserGifServiceException::class);
        $storeUserGifDto = new StoreUserGifDto(
            userId: 1,
            gifId: 1,
            alias: 'My favorite gif'
        );
        
        $this->mockUserGifRepository
            ->shouldReceive('storeGif')
            ->with($storeUserGifDto)
            ->andThrow(new \Exception('Error storing gif'));
        
        $service = $this->getUserGifService();
        
        $this->expectExceptionMessage('Error storing gif');
        $service->storeFavoriteGif($storeUserGifDto);
    }
    
    
}