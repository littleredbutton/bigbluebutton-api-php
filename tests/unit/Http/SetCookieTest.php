<?php

declare(strict_types=1);

/**
 * Copyright (c) 2015 Michael Dowling, https://github.com/mtdowling <mtdowling@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace BigBlueButton\Tests\Unit\Http;

use BigBlueButton\Http\SetCookie;
use PHPUnit\Framework\TestCase;

/**
 * Test of Value object for HTTP cookies.
 *
 * @covers \BigBlueButton\Http\SetCookie
 */
final class SetCookieTest extends TestCase
{
    /**
     * Provides the parsed information from a cookie.
     *
     * @return array<mixed>
     */
    public static function cookieParserDataProvider(): array
    {
        return [
            [
                'ASIHTTPRequestTestCookie=This+is+the+value; expires=Sat, 26-Jul-2008 17:00:42 GMT; path=/tests; domain=allseeing-i.com; PHPSESSID=6c951590e7a9359bcedde25cda73e43c; path=/;',
                [
                    'Name' => 'ASIHTTPRequestTestCookie',
                    'Value' => 'This+is+the+value',
                ],
            ],
            ['', null],
            ['foo', null],
            ['; foo', null],
            [
                'foo="bar"',
                [
                    'Name' => 'foo',
                    'Value' => '"bar"',
                ],
            ],
            // Test setting a blank value for a cookie
            [[
                'foo=', 'foo =', 'foo =;', 'foo= ;', 'foo =', 'foo= ', ],
                [
                    'Name' => 'foo',
                    'Value' => '',
                ],
            ],
            // Test setting a value and removing quotes
            [[
                'foo=1', 'foo =1', 'foo =1;', 'foo=1 ;', 'foo =1', 'foo= 1', 'foo = 1 ;', ],
                [
                    'Name' => 'foo',
                    'Value' => '1',
                ],
            ],
            // Some of the following tests are based on https://github.com/zendframework/zf1/blob/master/tests/Zend/Http/CookieTest.php
            [
                'justacookie=foo; domain=example.com',
                [
                    'Name' => 'justacookie',
                    'Value' => 'foo',
                ],
            ],
            [
                'expires=tomorrow; secure; path=/Space Out/; expires=Tue, 21-Nov-2006 08:33:44 GMT; domain=.example.com',
                [
                    'Name' => 'expires',
                    'Value' => 'tomorrow',
                ],
            ],
            [
                'domain=unittests; expires=Tue, 21-Nov-2006 08:33:44 GMT; domain=example.com; path=/some value/',
                [
                    'Name' => 'domain',
                    'Value' => 'unittests',
                ],
            ],
            [
                'path=indexAction; path=/; domain=.foo.com; expires=Tue, 21-Nov-2006 08:33:44 GMT',
                [
                    'Name' => 'path',
                    'Value' => 'indexAction',
                ],
            ],
            [
                'secure=sha1; secure; SECURE; domain=some.really.deep.domain.com; version=1; Max-Age=86400',
                [
                    'Name' => 'secure',
                    'Value' => 'sha1',
                ],
            ],
            [
                'PHPSESSID=123456789+abcd%2Cef; secure; discard; domain=.localdomain; path=/foo/baz; expires=Tue, 21-Nov-2006 08:33:44 GMT;',
                [
                    'Name' => 'PHPSESSID',
                    'Value' => '123456789+abcd%2Cef',
                ],
            ],
        ];
    }

    /**
     * @dataProvider cookieParserDataProvider
     *
     * @param array<mixed>|string $cookie
     * @param array<mixed>        $parsed
     */
    public function testParseCookie(array|string $cookie, ?array $parsed): void
    {
        foreach ((array) $cookie as $v) {
            $parsedCookie = SetCookie::fromString($v);

            if ($parsed === null) {
                self::assertNull($parsedCookie);
                continue;
            }

            self::assertEquals($parsedCookie->getName(), $parsed['Name']);
            self::assertEquals($parsedCookie->getValue(), $parsed['Value']);
        }
    }
}
