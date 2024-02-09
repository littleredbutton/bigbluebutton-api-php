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

use BigBlueButton\Enum\Role;
use BigBlueButton\TestCase;

final class JoinMeetingParametersTest extends TestCase
{
    public function testJoinMeetingParameters(): void
    {
        $params = $this->generateJoinMeetingParams();
        $params['role'] = Role::MODERATOR;
        $joinMeetingParams = $this->getJoinMeetingMock($params);

        $this->assertEquals($params['meetingID'], $joinMeetingParams->getMeetingID());
        $this->assertEquals($params['fullName'], $joinMeetingParams->getFullName());
        $this->assertEquals($params['role'], $joinMeetingParams->getRole());
        $this->assertEquals($params['userID'], $joinMeetingParams->getUserID());
        $this->assertEquals($params['webVoiceConf'], $joinMeetingParams->getWebVoiceConf());
        $this->assertEquals($params['createTime'], $joinMeetingParams->getCreateTime());
        $this->assertEquals($params['errorRedirectUrl'], $joinMeetingParams->getErrorRedirectUrl());
        $this->assertEquals($params['userdata-countrycode'], $joinMeetingParams->getUserData('countrycode'));
        $this->assertEquals($params['userdata-email'], $joinMeetingParams->getUserData('email'));
        $this->assertEquals($params['userdata-commercial'], $joinMeetingParams->getUserData('commercial'));

        // Test setters that are ignored by the constructor
        $joinMeetingParams->setMeetingID($newId = $this->faker->uuid);
        $joinMeetingParams->setFullName($newName = $this->faker->name);
        $joinMeetingParams->setRole($newRole = Role::VIEWER);
        $joinMeetingParams->setConfigToken($configToken = $this->faker->md5);
        $joinMeetingParams->setAvatarURL($avatarUrl = $this->faker->url);
        $joinMeetingParams->setRedirect($redirect = $this->faker->boolean(50));
        $joinMeetingParams->setClientURL($clientUrl = $this->faker->url);
        $joinMeetingParams->setErrorRedirectUrl($newErrorRedirectUrl = $this->faker->url);
        $joinMeetingParams->setGuest($guest = $this->faker->boolean(50));
        $this->assertEquals($newId, $joinMeetingParams->getMeetingID());
        $this->assertEquals($newName, $joinMeetingParams->getFullName());
        $this->assertEquals($newRole, $joinMeetingParams->getRole());
        $this->assertEquals($configToken, $joinMeetingParams->getConfigToken());
        $this->assertEquals($avatarUrl, $joinMeetingParams->getAvatarURL());
        $this->assertEquals($redirect, $joinMeetingParams->isRedirect());
        $this->assertEquals($clientUrl, $joinMeetingParams->getClientURL());
        $this->assertEquals($newErrorRedirectUrl, $joinMeetingParams->getErrorRedirectUrl());
        $this->assertEquals($guest, $joinMeetingParams->isGuest());
    }

    /**
     * @group legacy
     * Using the deprecated getPassword method, without setting the password in the constructor or using the setPassword method
     */
    public function testJoinMeetingParametersWithoutPassword(): void
    {
        $params = $this->generateJoinMeetingParams();
        $joinMeetingParams = $this->getJoinMeetingMock($params);

        $this->expectException(\RuntimeException::class);

        $joinMeetingParams->getPassword();
    }

    /**
     * @group legacy
     * Using the deprecated getPassword method, with passing the password in the constructor
     */
    public function testJoinMeetingParametersWithPassword(): void
    {
        $params = $this->generateJoinMeetingParams();
        // Legacy, allow users to pass a password as the third constructor parameter
        $params['role'] = $this->faker->password;
        $joinMeetingParams = $this->getJoinMeetingMock($params);

        // Check if the password is set and the role is null
        $this->assertSame($params['role'], $joinMeetingParams->getPassword());
        $this->assertNull($joinMeetingParams->getRole());
    }

    /**
     * @group legacy
     * Using the deprecated getPassword method, with using the setPassword method
     */
    public function testJoinMeetingParametersWithSetPassword(): void
    {
        $params = $this->generateJoinMeetingParams();
        $joinMeetingParams = $this->getJoinMeetingMock($params);

        $joinMeetingParams->setPassword($password = $this->faker->password);
        $this->assertSame($password, $joinMeetingParams->getPassword());
    }
}
