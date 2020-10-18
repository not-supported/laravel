<?php


namespace NotSupported\Laravel\Tests;

use Illuminate\Support\Facades\Config;
use NotSupported\Laravel\NotSupported;
use Orchestra\Testbench\TestCase;


class IsSupportedTest extends TestCase
{
    /**
     * @dataProvider testProvider
     */
    public function test_is_supported_method($browserFamily, $browsermajor, $result)
    {
        Config::set([
            'not-supported.referrer' => false,
            'not-supported.browsers' => [
                'chrome'  => '>=60',
                'firefox' => '>60',
                'edge'    => '>60',
                'opera'   => '>30',
            ],
        ]);

        $mock = $this->partialMock(NotSupported::class, function ($mock) use ($browserFamily, $browsermajor) {
            $mock->shouldReceive('getBrowserAndMajorVersion')
                 ->once()
                 ->andReturn([$browserFamily, $browsermajor]);
        });

        $this->assertEquals($result, $mock->isSupported());
    }

    public function testProvider()
    {
        return [
            ['Chrome', 0, false],
            ['Chrome', 59, false],
            ['Chrome', 60, true],
            ['Chrome', 61, true],
            ['Firefox', 0, false],
            ['Firefox', 59, false],
            ['Firefox', 60, false],
            ['Firefox', 61, true],
            ['Edge', 29, false],
            ['Edge', 30, false],
            ['Edge', 60, false],
            ['Edge', 61, true],
        ];
    }
}