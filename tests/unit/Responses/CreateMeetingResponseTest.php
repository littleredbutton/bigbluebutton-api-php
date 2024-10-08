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

use BigBlueButton\Responses\CreateMeetingResponse;
use BigBlueButton\Tests\Common\TestCase;

final class CreateMeetingResponseTest extends TestCase
{
    private CreateMeetingResponse $meeting;

    protected function setUp(): void
    {
        parent::setUp();

        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'create_meeting.xml');

        $this->meeting = new CreateMeetingResponse($xml);
    }

    public function testCreateMeetingResponseContent(): void
    {
        $this->assertTrue($this->meeting->success());
        $this->assertFalse($this->meeting->failed());
        $this->assertEquals('SUCCESS', $this->meeting->getReturnCode());

        $this->assertEquals('random-1665177', $this->meeting->getMeetingId());
        $this->assertEquals('1a6938c707cdf5d052958672d66c219c30690c47-1524212045514', $this->meeting->getInternalMeetingId());
        $this->assertEquals('bbb-none', $this->meeting->getParentMeetingId());
        $this->assertEquals(1453283819419, $this->meeting->getCreationTime());
        $this->assertEquals(76286, $this->meeting->getVoiceBridge());
        $this->assertEquals('Wed Jan 20 04:56:59 EST 2016', $this->meeting->getCreationDate());
        $this->assertEquals('613-555-1234', $this->meeting->getDialNumber());
        $this->assertFalse($this->meeting->hasUserJoined());
        $this->assertEquals(20, $this->meeting->getDuration());
        $this->assertFalse($this->meeting->hasBeenForciblyEnded());
        $this->assertEquals('duplicateWarning', $this->meeting->getMessageKey());
        $this->assertTrue($this->meeting->isDuplicate());
        $this->assertEquals('This conference was already in existence and may currently be in progress.', $this->meeting->getMessage());

        $this->assertFalse($this->meeting->isIdNotUnique());
    }

    public function testCreateMeetingResponseTypes(): void
    {
        $this->assertEachGetterValueIsString($this->meeting, [
            'getReturnCode', 'getInternalMeetingId', 'getParentMeetingId',
            'getDialNumber', 'getCreationDate',
        ]);
        $this->assertEachGetterValueIsDouble($this->meeting, ['getCreationTime']);
        $this->assertEachGetterValueIsInteger($this->meeting, ['getDuration', 'getVoiceBridge']);
        $this->assertEachGetterValueIsBoolean($this->meeting, ['hasUserJoined', 'hasBeenForciblyEnded']);
    }

    public function testIdNotUnique(): void
    {
        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'create_meeting_not_unique_error.xml');

        $meeting = new CreateMeetingResponse($xml);

        $this->assertFalse($meeting->success());
        $this->assertTrue($meeting->failed());
        $this->assertEquals('FAILED', $meeting->getReturnCode());

        $this->assertTrue($meeting->isIdNotUnique());
    }
}
