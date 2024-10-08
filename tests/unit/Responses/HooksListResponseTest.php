<?php

declare(strict_types=1);

/**
 * BigBlueButton open source conferencing system - https://www.bigbluebutton.org/.
 *
 * Copyright (c) 2016-2018 BigBlueButton Inc. and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * BigBlueButton is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with BigBlueButton; if not, see <http://www.gnu.org/licenses/>.
 */

namespace BigBlueButton\Tests\Unit\Responses;

use BigBlueButton\Responses\HooksListResponse;
use BigBlueButton\Tests\Common\TestCase;

final class HooksListResponseTest extends TestCase
{
    private HooksListResponse $listResponse;

    protected function setUp(): void
    {
        parent::setUp();

        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'hooks_list.xml');

        $this->listResponse = new HooksListResponse($xml);
    }

    public function testHooksListResponseContent(): void
    {
        $this->assertEquals('SUCCESS', $this->listResponse->getReturnCode());
        $this->assertCount(2, $this->listResponse->getHooks());

        $aHook = $this->listResponse->getHooks()[0];

        $this->assertEquals('my-meeting', $aHook->getMeetingId());
        $this->assertEquals('http://postcatcher.in/catchers/abcdefghijk', $aHook->getCallbackUrl());
        $this->assertEquals(1, $aHook->getHookId());
        $this->assertFalse($aHook->isPermanentHook());
        $this->assertFalse($aHook->hasRawData());
    }

    public function testHooksListResponseTypes(): void
    {
        $this->assertEachGetterValueIsString($this->listResponse, ['getReturnCode']);

        $aHook = $this->listResponse->getHooks()[0];

        $this->assertEachGetterValueIsString($aHook, ['getCallbackUrl', 'getMeetingId']);
        $this->assertEachGetterValueIsInteger($aHook, ['getHookId']);
        $this->assertEachGetterValueIsBoolean($aHook, ['hasRawData', 'isPermanentHook']);
    }
}
