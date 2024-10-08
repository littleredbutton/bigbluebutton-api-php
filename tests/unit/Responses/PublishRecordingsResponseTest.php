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

use BigBlueButton\Responses\PublishRecordingsResponse;
use BigBlueButton\Tests\Common\TestCase;

final class PublishRecordingsResponseTest extends TestCase
{
    private PublishRecordingsResponse $publish;

    protected function setUp(): void
    {
        parent::setUp();

        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'publish_recordings.xml');

        $this->publish = new PublishRecordingsResponse($xml);
    }

    public function testPublishRecordingsResponseContent(): void
    {
        $this->assertEquals('SUCCESS', $this->publish->getReturnCode());
        $this->assertTrue($this->publish->isPublished());
    }

    public function testPublishRecordingsResponseTypes(): void
    {
        $this->assertEachGetterValueIsString($this->publish, ['getReturnCode']);
        $this->assertEachGetterValueIsBoolean($this->publish, ['isPublished']);
    }

    public function testNotFoundError(): void
    {
        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'not_found_error.xml');

        $publish = new PublishRecordingsResponse($xml);

        $this->assertTrue($publish->failed());
        $this->assertTrue($publish->isNotFound());
    }
}
