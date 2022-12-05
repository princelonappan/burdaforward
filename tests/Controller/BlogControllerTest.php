<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use GuzzleHttp;

class BlogControllerTest extends TestCase
{
    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'dynamic-router:8005']);
    }

    public function testWithIndexRoute(): void
    {
        $response = $this->http->request('GET', '/');
        $htmlContent = $response->getBody()->__toString();
        $this->assertNotEmpty($htmlContent);
        $this->assertStringContainsString('Index Page', $htmlContent);
    }

    public function testWithInvalidRoute(): void
    {
        try {
            $response = $this->http->request('GET', '/sampletest/22');
        } catch (\Exception $e) {
            // fallback, in case of other exception
            $this->assertStringContainsString('route not found', $e->getMessage());
        }
    }

    public function testWithBlogRoute(): void
    {
        $response = $this->http->request('GET', '/blog');
        $htmlContent = $response->getBody()->__toString();
        $this->assertNotEmpty($htmlContent);
        $this->assertStringContainsString('Blog Page', $htmlContent);
    }

    public function testWithBlogParametersRoute(): void
    {
        $response = $this->http->request('GET', '/blog/2021/10');
        $htmlContent = $response->getBody()->__toString();
        $this->assertNotEmpty($htmlContent);
        $this->assertStringContainsString('Parameters', $htmlContent);
    }

    public function testWithBlogParametersInvalidRoute(): void
    {
        try {
            $response = $this->http->request('GET', '/blog/zazaz/10');
            $htmlContent = $response->getBody()->__toString();
        } catch (\Exception $e) {
            // fallback, in case of other exception
            $this->assertStringContainsString('Invalid parameters', $e->getMessage());
        }
    }
}