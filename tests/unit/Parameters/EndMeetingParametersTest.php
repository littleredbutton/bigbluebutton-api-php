<?php
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

namespace BigBlueButton\Parameters;

use BigBlueButton\TestCase;

final class EndMeetingParametersTest extends TestCase
{
    public function testEndMeetingParameters(): void
    {
        $endMeetingParams = new EndMeetingParameters($meetingId = $this->faker->uuid, $password = $this->faker->password());

        $this->assertEquals($meetingId, $endMeetingParams->getMeetingID());
        $this->assertEquals($password, $endMeetingParams->getPassword());

        // Test setters that are ignored by the constructor
        $endMeetingParams->setMeetingID($newId = $this->faker->uuid);
        $endMeetingParams->setPassword($newPassword = $this->faker->password);
        $this->assertEquals($newId, $endMeetingParams->getMeetingID());
        $this->assertEquals($newPassword, $endMeetingParams->getPassword());
    }

    /**
     * @group legacy
     */
    public function testEndMeetingParametersWithoutPassword(): void
    {
        $endMeetingParams = new EndMeetingParameters($this->faker->uuid);

        $this->expectException(\RuntimeException::class);

        $endMeetingParams->getPassword();
    }

    /**
     * @group legacy
     */
    public function testEndMeetingParametersWithSetPassword(): void
    {
        $endMeetingParams = new EndMeetingParameters($this->faker->uuid);

        $endMeetingParams->setPassword($password = $this->faker->password);
        $this->assertSame($password, $endMeetingParams->getPassword());
    }
}
