<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 21:31
 */

namespace Tests\Unit\GiphyService;

use App\Dtos\Giphy\SearchByIdGifResponseDto;
use App\Exceptions\GiphyServiceException;
use App\Services\GiphyService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SearchGifByIdTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    
    private function getGiphyService(): GiphyService
    {
        return new GiphyService();
    }
    
    public function test_can_instantiate_service()
    {
        $service = $this->getGiphyService();
        $this->assertInstanceOf(GiphyService::class, $service);
    }
    
    /**
     * Url to fake
     * @return string
     */
    private function getFakeUrl(): string
    {
        return config('giphy.api.url') . '*';
    }
    
    public function test_get_gif_by_id(): void
    {
        $giphyService = $this->getGiphyService();
        $fileResponse = file_get_contents(base_path('tests/Unit/stubs/search_by_id_response.json'));
        $url = $this->getFakeUrl();
        //Fake the response
        Http::fake([
            $url => Http::response(json_decode($fileResponse, true)),
        ]);
        $response = $giphyService->getGifById('testId');
        $this->assertInstanceOf(SearchByIdGifResponseDto::class, $response);
        $this->assertIsArray($response->meta);
        $this->assertEquals('testId', $response->data->id);
    }
    
    //test handle not found response
    public function test_get_gif_by_id_handle_not_found(): void
    {
        $this->expectException(GiphyServiceException::class);
        $giphyService = $this->getGiphyService();
        $fileResponse = file_get_contents(base_path('tests/Unit/stubs/search_by_id_response_not_found.json'));
        $url = $this->getFakeUrl();
        //Fake the response
        Http::fake([
            $url => Http::response(json_decode($fileResponse, true), 404),
        ]);
        $response = $giphyService->getGifById('testId');
        $this->assertInstanceof(SearchByIdGifResponseDto::class, $response);
        $this->assertEmpty($response->data);
        $this->assertStringContainsString('Not Found', $response->meta['msg']);
        $this->assertStringContainsString('404', $response->meta['status']);
    }
    
    public function test_get_gif_by_id_handle_exception(): void
    {
        $this->expectException(GiphyServiceException::class);
        $giphyService = $this->getGiphyService();
        $url = $this->getFakeUrl();
        Http::fake([$url => Http::response([], 500)]);
        $response = $giphyService->getGifById('testId');
    }
    
}