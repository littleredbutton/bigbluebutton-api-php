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

use BigBlueButton\Responses\UpdateRecordingsResponse;
use BigBlueButton\Tests\Common\TestCase;

final class UpdateRecordingsResponseTest extends TestCase
{
    private UpdateRecordingsResponse $update;

    protected function setUp(): void
    {
        parent::setUp();

        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'update_recordings.xml');

        $this->update = new UpdateRecordingsResponse($xml);
    }

    public function testUpdateRecordingsResponseContent(): void
    {
        $this->assertEquals('SUCCESS', $this->update->getReturnCode());
        $this->assertTrue($this->update->isUpdated());
    }

    public function testUpdateRecordingsResponseTypes(): void
    {
        $this->assertEachGetterValueIsString($this->update, ['getReturnCode']);
        $this->assertEachGetterValueIsBoolean($this->update, ['isUpdated']);
    }

    public function testNotFoundError(): void
    {
        $xml = $this->loadXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'not_found_error.xml');

        $update = new UpdateRecordingsResponse($xml);

        $this->assertTrue($update->failed());
        $this->assertTrue($update->isNotFound());
    }
}
