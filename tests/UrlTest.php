<?php

namespace NotSupported\Laravel\Tests;

use Illuminate\Support\Facades\Config;
use NotSupported\Laravel\NotSupported;
use Orchestra\Testbench\TestCase;

class UrlTest extends TestCase
{
    public function test_basic_referrer()
    {
        Config::set([
            'not-supported.referrer' => true,
        ]);

        $mock = $this->partialMock(NotSupported::class, function ($mock) {
            $mock->shouldReceive('requestFullUrl')
                 ->once()
                 ->andReturn('https://github.com/not-supported/laravel');
        });

        $url = 'https://notsupported.app/?referrer=' . urlencode('https://github.com/not-supported/laravel');

        $this->assertEquals($url, $mock->url());

    }

    public function test_custom_referrer()
    {
        Config::set([
            'not-supported.referrer'        => true,
            'not-supported.custom_referrer' => 'https://github.com',
        ]);

        $this->assertEquals('https://notsupported.app/?referrer=https%3A%2F%2Fgithub.com', (new NotSupported)->url());
    }

    public function test_no_referrer()
    {
        Config::set(['not-supported.custom_referrer' => false]);

        $this->assertEquals('https://notsupported.app', (new NotSupported)->url());
    }

    public function test_no_referrer_but_with_custom_referrer()
    {
        Config::set(['not-supported.custom_referrer' => false]);

        $this->assertEquals('https://notsupported.app', (new NotSupported)->url());
    }
}
