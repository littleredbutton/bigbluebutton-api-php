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

use BigBlueButton\Core\GuestPolicy;
use BigBlueButton\Enum\Feature;
use BigBlueButton\TestCase;

/**
 * Class CreateMeetingParametersTest.
 */
final class CreateMeetingParametersTest extends TestCase
{
    public function testCreateMeetingParameters()
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);

        $this->assertEquals($params['name'], $createMeetingParams->getName());
        $this->assertEquals($params['meetingID'], $createMeetingParams->getMeetingID());
        $this->assertEquals($params['attendeePW'], $createMeetingParams->getAttendeePW());
        $this->assertEquals($params['moderatorPW'], $createMeetingParams->getModeratorPW());
        $this->assertEquals($params['autoStartRecording'], $createMeetingParams->isAutoStartRecording());
        $this->assertEquals($params['dialNumber'], $createMeetingParams->getDialNumber());
        $this->assertEquals($params['voiceBridge'], $createMeetingParams->getVoiceBridge());
        $this->assertEquals($params['logoutURL'], $createMeetingParams->getLogoutURL());
        $this->assertEquals($params['maxParticipants'], $createMeetingParams->getMaxParticipants());
        $this->assertEquals($params['record'], $createMeetingParams->isRecord());
        $this->assertEquals($params['duration'], $createMeetingParams->getDuration());
        $this->assertEquals($params['welcome'], $createMeetingParams->getWelcome());
        $this->assertEquals($params['allowStartStopRecording'], $createMeetingParams->isAllowStartStopRecording());
        $this->assertEquals($params['moderatorOnlyMessage'], $createMeetingParams->getModeratorOnlyMessage());
        $this->assertEquals($params['webcamsOnlyForModerator'], $createMeetingParams->isWebcamsOnlyForModerator());
        $this->assertEquals($params['logo'], $createMeetingParams->getLogo());
        $this->assertEquals($params['copyright'], $createMeetingParams->getCopyright());
        $this->assertEquals($params['muteOnStart'], $createMeetingParams->isMuteOnStart());
        $this->assertEquals($params['guestPolicy'], $createMeetingParams->getGuestPolicy());
        $this->assertEquals($params['lockSettingsDisableCam'], $createMeetingParams->isLockSettingsDisableCam());
        $this->assertEquals($params['lockSettingsDisableMic'], $createMeetingParams->isLockSettingsDisableMic());
        $this->assertEquals($params['lockSettingsDisablePrivateChat'], $createMeetingParams->isLockSettingsDisablePrivateChat());
        $this->assertEquals($params['lockSettingsDisablePublicChat'], $createMeetingParams->isLockSettingsDisablePublicChat());
        $this->assertEquals($params['lockSettingsDisableNote'], $createMeetingParams->isLockSettingsDisableNote());
        $this->assertEquals($params['lockSettingsLockedLayout'], $createMeetingParams->isLockSettingsLockedLayout());
        $this->assertEquals($params['lockSettingsHideUserList'], $createMeetingParams->isLockSettingsHideUserList());
        $this->assertEquals($params['lockSettingsLockOnJoin'], $createMeetingParams->isLockSettingsLockOnJoin());
        $this->assertEquals($params['lockSettingsLockOnJoinConfigurable'], $createMeetingParams->isLockSettingsLockOnJoinConfigurable());
        $this->assertEquals($params['allowModsToUnmuteUsers'], $createMeetingParams->isAllowModsToUnmuteUsers());
        $this->assertEquals($params['allowModsToEjectCameras'], $createMeetingParams->isAllowModsToEjectCameras());
        $this->assertEquals($params['guestPolicy'], $createMeetingParams->getGuestPolicy());
        $this->assertEquals($params['endWhenNoModerator'], $createMeetingParams->isEndWhenNoModerator());
        $this->assertEquals($params['endWhenNoModeratorDelayInMinutes'], $createMeetingParams->getEndWhenNoModeratorDelayInMinutes());
        $this->assertEquals($params['learningDashboardEnabled'], $createMeetingParams->isLearningDashboardEnabled());
        $this->assertEquals($params['learningDashboardCleanupDelayInMinutes'], $createMeetingParams->getLearningDashboardCleanupDelayInMinutes());
        $this->assertEquals($params['breakoutRoomsEnabled'], $createMeetingParams->isBreakoutRoomsEnabled());
        $this->assertEquals($params['breakoutRoomsRecord'], $createMeetingParams->isBreakoutRoomsRecord());
        $this->assertEquals($params['breakoutRoomsPrivateChatEnabled'], $createMeetingParams->isBreakoutRoomsPrivateChatEnabled());
        $this->assertEquals($params['meetingEndedURL'], $createMeetingParams->getMeetingEndedURL());
        $this->assertEquals($params['meetingLayout'], $createMeetingParams->getMeetingLayout());
        $this->assertEquals($params['meta_presenter'], $createMeetingParams->getMeta('presenter'));
        $this->assertEquals($params['meta_endCallbackUrl'], $createMeetingParams->getMeta('endCallbackUrl'));
        $this->assertEquals($params['meta_bbb-recording-ready-url'], $createMeetingParams->getMeta('bbb-recording-ready-url'));
        $this->assertEquals($params['bannerText'], $createMeetingParams->getBannerText());
        $this->assertEquals($params['bannerColor'], $createMeetingParams->getBannerColor());
        $this->assertEquals($params['meetingKeepEvents'], $createMeetingParams->isMeetingKeepEvents());
        $this->assertEquals($params['endWhenNoModerator'], $createMeetingParams->isEndWhenNoModerator());
        $this->assertEquals($params['endWhenNoModeratorDelayInMinutes'], $createMeetingParams->getEndWhenNoModeratorDelayInMinutes());
        $this->assertEquals($params['meetingLayout'], $createMeetingParams->getMeetingLayout());
        $this->assertEquals($params['learningDashboardEnabled'], $createMeetingParams->isLearningDashboardEnabled());
        $this->assertEquals($params['learningDashboardCleanupDelayInMinutes'], $createMeetingParams->getLearningDashboardCleanupDelayInMinutes());
        $this->assertEquals($params['allowModsToEjectCameras'], $createMeetingParams->isAllowModsToEjectCameras());
        $this->assertEquals($params['breakoutRoomsEnabled'], $createMeetingParams->isBreakoutRoomsEnabled());
        $this->assertEquals($params['breakoutRoomsPrivateChatEnabled'], $createMeetingParams->isBreakoutRoomsPrivateChatEnabled());
        $this->assertEquals($params['breakoutRoomsRecord'], $createMeetingParams->isBreakoutRoomsRecord());
        $this->assertEquals($params['allowRequestsWithoutSession'], $createMeetingParams->isAllowRequestsWithoutSession());
        $this->assertEquals($params['virtualBackgroundsDisabled'], $createMeetingParams->isVirtualBackgroundsDisabled());
        $this->assertEquals(json_encode($params['groups']), json_encode($createMeetingParams->getBreakoutRoomsGroups()));
        $this->assertEquals($params['disabledFeatures'], $createMeetingParams->getDisabledFeatures());
        $this->assertEquals($params['disabledFeaturesExclude'], $createMeetingParams->getDisabledFeaturesExclude());

        // Check values are empty of this is not a breakout room
        $this->assertNull($createMeetingParams->isBreakout());
        $this->assertNull($createMeetingParams->getParentMeetingID());
        $this->assertNull($createMeetingParams->getSequence());
        $this->assertNull($createMeetingParams->isFreeJoin());

        // Test setters that are ignored by the constructor
        $createMeetingParams->setMeetingID($newId = $this->faker->uuid);
        $createMeetingParams->setName($newName = $this->faker->name);
        $this->assertEquals($newName, $createMeetingParams->getName());
        $this->assertEquals($newId, $createMeetingParams->getMeetingID());
    }

    public function testMetaParameters(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);
        $createMeetingParams->addMeta('userdata-bbb_hide_presentation_on_join', true);
        $createMeetingParams->addMeta('userdata-bbb_show_participants_on_login', false);
        $createMeetingParams->addMeta('userdata-bbb_fullaudio_bridge', 'fullaudio');

        // Test getters
        $this->assertTrue($createMeetingParams->getMeta('userdata-bbb_hide_presentation_on_join'));
        $this->assertFalse($createMeetingParams->getMeta('userdata-bbb_show_participants_on_login'));
        $this->assertEquals('fullaudio', $createMeetingParams->getMeta('userdata-bbb_fullaudio_bridge'));

        $params = urldecode($createMeetingParams->getHTTPQuery());

        // Test HTTP query
        $this->assertStringContainsString('meta_userdata-bbb_hide_presentation_on_join=true', $params);
        $this->assertStringContainsString('meta_userdata-bbb_show_participants_on_login=false', $params);
        $this->assertStringContainsString('meta_userdata-bbb_fullaudio_bridge=fullaudio', $params);
    }

    public function testDisabledFeatures(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);

        // Test empty disabled features
        $createMeetingParams->setDisabledFeatures([]);
        $params = urldecode($createMeetingParams->getHTTPQuery());
        $this->assertStringNotContainsString('disabledFeatures=', $params);

        // Test with multiple disabled features
        $createMeetingParams->setDisabledFeatures([Feature::CHAT, Feature::POLLS, Feature::CAPTIONS]);
        $params = urldecode($createMeetingParams->getHTTPQuery());
        $this->assertStringContainsString('disabledFeatures=chat,polls,captions', $params);

        // Test empty disabled features exclude
        $createMeetingParams->setDisabledFeaturesExclude([]);
        $params = urldecode($createMeetingParams->getHTTPQuery());
        $this->assertStringNotContainsString('disabledFeaturesExclude=', $params);

        // Test with multiple disabled features exclude
        $createMeetingParams->setDisabledFeaturesExclude([Feature::CHAT, Feature::POLLS]);
        $params = urldecode($createMeetingParams->getHTTPQuery());
        $this->assertStringContainsString('disabledFeaturesExclude=chat,polls', $params);
    }

    public function testCreateBreakoutMeeting()
    {
        $params = $this->generateBreakoutCreateParams($this->generateCreateParams());
        $createBreakoutMeetingParams = $this->getBreakoutCreateMock($params);
        $this->assertEquals($params['isBreakout'], $createBreakoutMeetingParams->isBreakout());
        $this->assertEquals($params['parentMeetingId'], $createBreakoutMeetingParams->getParentMeetingID());
        $this->assertEquals($params['sequence'], $createBreakoutMeetingParams->getSequence());
        $this->assertEquals($params['freeJoin'], $createBreakoutMeetingParams->isFreeJoin());

        $params = $createBreakoutMeetingParams->getHTTPQuery();

        $this->assertStringContainsString('isBreakout='.rawurlencode($createBreakoutMeetingParams->isBreakout() ? 'true' : 'false'), $params);
        $this->assertStringContainsString('parentMeetingID='.rawurlencode($createBreakoutMeetingParams->getParentMeetingID()), $params);
        $this->assertStringContainsString('sequence='.rawurlencode($createBreakoutMeetingParams->getSequence()), $params);
        $this->assertStringContainsString('freeJoin='.rawurlencode($createBreakoutMeetingParams->isFreeJoin() ? 'true' : 'false'), $params);
    }

    public function testCreateBreakoutMeetingWithMissingParams(): void
    {
        $this->expectException(\RuntimeException::class);

        $params = new CreateMeetingParameters($this->faker->uuid, $this->faker->name);
        $params->setBreakout(true);
        $params->getHTTPQuery();
    }

    public function testNonExistingProperty(): void
    {
        $this->expectException(\BadFunctionCallException::class);

        $params = new CreateMeetingParameters($this->faker->uuid, $this->faker->name);
        $params->getFoobar();
    }

    public function testWrongMethodName(): void
    {
        $this->expectException(\BadFunctionCallException::class);

        $params = new CreateMeetingParameters($this->faker->uuid, $this->faker->name);
        $params->getname();
    }

    public function testGetPresentationsAsXMLWithUrl(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);
        $createMeetingParams->addPresentation('http://test-install.blindsidenetworks.com/default.pdf');
        $this->assertXmlStringEqualsXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'presentation_with_url.xml', $createMeetingParams->getPresentationsAsXML());
    }

    public function testGetPresentationsAsXMLWithUrlAndFilename(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);
        $createMeetingParams->addPresentation('http://test-install.blindsidenetworks.com/default.pdf', null, 'presentation.pdf');
        $this->assertXmlStringEqualsXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'presentation_with_filename.xml', $createMeetingParams->getPresentationsAsXML());
    }

    public function testGetPresentationsAsXMLWithFile(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);
        $createMeetingParams->addPresentation('bbb_logo.png', file_get_contents(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'bbb_logo.png'));
        $this->assertXmlStringEqualsXmlFile(__DIR__.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'..'.\DIRECTORY_SEPARATOR.'fixtures'.\DIRECTORY_SEPARATOR.'presentation_with_embedded_file.xml', $createMeetingParams->getPresentationsAsXML());
    }

    public function testUserCameraCap(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);
        $this->assertEquals($params['userCameraCap'], $createMeetingParams->getUserCameraCap());
        $this->assertFalse($createMeetingParams->isUserCameraCapDisabled());

        $createMeetingParams->disableUserCameraCap();
        $this->assertEquals(0, $createMeetingParams->getUserCameraCap());
        $this->assertTrue($createMeetingParams->isUserCameraCapDisabled());
    }

    public function testGuestPolicyAlwaysAccept(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);

        $createMeetingParams->setGuestPolicyAlwaysAccept();
        $this->assertSame(GuestPolicy::ALWAYS_ACCEPT, $createMeetingParams->getGuestPolicy());
        $this->assertTrue($createMeetingParams->isGuestPolicyAlwaysAccept());
    }

    public function testGuestPolicyAlwaysAcceptAuth(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);

        $createMeetingParams->setGuestPolicyAlwaysAcceptAuth();
        $this->assertSame(GuestPolicy::ALWAYS_ACCEPT_AUTH, $createMeetingParams->getGuestPolicy());
        $this->assertTrue($createMeetingParams->isGuestPolicyAlwaysAcceptAuth());
    }

    public function testGuestPolicyAlwaysDeny(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);

        $createMeetingParams->setGuestPolicyAlwaysDeny();
        $this->assertSame(GuestPolicy::ALWAYS_DENY, $createMeetingParams->getGuestPolicy());
        $this->assertTrue($createMeetingParams->isGuestPolicyAlwaysDeny());
    }

    public function testGuestPolicyAskModerator(): void
    {
        $params = $this->generateCreateParams();
        $createMeetingParams = $this->getCreateMock($params);

        $createMeetingParams->setGuestPolicyAskModerator();
        $this->assertSame(GuestPolicy::ASK_MODERATOR, $createMeetingParams->getGuestPolicy());
        $this->assertTrue($createMeetingParams->isGuestPolicyAskModerator());
    }

    /**
     * @group legacy
     */
    public function testCreateMeetingParametersWithoutAttendeePassword(): void
    {
        $params = $this->generateCreateParams();
        unset($params['attendeePW']);
        $createMeetingParams = $this->getCreateMock($params);

        $this->expectException(\RuntimeException::class);
        $createMeetingParams->getAttendeePW();
    }

    /**
     * @group legacy
     */
    public function testCreateMeetingParametersWithoutModeratorPassword(): void
    {
        $params = $this->generateCreateParams();
        unset($params['moderatorPW']);
        $createMeetingParams = $this->getCreateMock($params);

        $this->expectException(\RuntimeException::class);
        $createMeetingParams->getModeratorPW();
    }
}
