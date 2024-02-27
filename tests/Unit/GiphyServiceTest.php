<?php

namespace Tests\Unit;

use App\Dtos\Giphy\SearchGifRequestDto;
use App\Dtos\Giphy\SearchGifResponseDto;
use App\Exceptions\GiphyServiceException;
use App\Services\GiphyService;
use Exception;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GiphyServiceTest extends TestCase
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
     * @throws Exception
     */
    public function test_get_gif_by_keyword(): void
    {
        $giphyService = $this->getGiphyService();
        $fileResponse = file_get_contents(base_path('tests/Unit/stubs/search_by_keyword_response.json'));
        $url = $this->getFakeUrl();
        //Fake the response
        Http::fake([
            $url => Http::response(json_decode($fileResponse, true)),
        ]);
        $dto = new SearchGifRequestDto('test', 1, 0);
        $response = $giphyService->getGifByKeyword($dto);
        $this->assertInstanceOf(SearchGifResponseDto::class, $response);
        $this->assertIsArray($response->data);
        $this->assertIsArray($response->pagination);
        $this->assertIsArray($response->meta);
        $this->assertCount(1, $response->data);
        $this->assertEquals('testIdResponse', $response->data[0]->id);
    }
    
    public function test_get_gif_by_keyword_handle_empty_results(): void
    {
        $giphyService = $this->getGiphyService();
        $url = $this->getFakeUrl();
        $fileResponse = file_get_contents(base_path('tests/Unit/stubs/search_by_keyword_empty_response.json'));
        Http::fake([$url => Http::response(json_decode($fileResponse, true))]);
        $dto = new SearchGifRequestDto('word-without-results');
        $response = $giphyService->getGifByKeyword($dto);
        $this->assertInstanceOf(SearchGifResponseDto::class, $response);
        $this->assertIsArray($response->data);
        $this->assertIsArray($response->pagination);
        $this->assertIsArray($response->meta);
        $this->assertCount(0, $response->data);
    }
    
    /**
     * @throws Exception
     */
    public function test_get_gif_by_keyword_throws_exception(): void
    {
        $this->expectException(GiphyServiceException::class);
        $url = $this->getFakeUrl();
        Http::fake([$url => Http::response(status: 500)]);
        $giphyService = $this->getGiphyService();
        $dto = new SearchGifRequestDto('test', 10, 0);
        $giphyService->getGifByKeyword($dto);
    }
    
    /**
     * Url to fake
     * @return string
     */
    private function getFakeUrl(): string
    {
        return config('giphy.api.url') . '*';
    }
}
