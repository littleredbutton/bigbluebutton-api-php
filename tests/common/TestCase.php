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

namespace BigBlueButton\Tests\Common;

use BigBlueButton\BigBlueButton;
use BigBlueButton\Core\GuestPolicy;
use BigBlueButton\Core\MeetingLayout;
use BigBlueButton\Enum\Feature;
use BigBlueButton\Enum\Role;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\UpdateRecordingsParameters;
use BigBlueButton\Responses\CreateMeetingResponse;
use BigBlueButton\Responses\UpdateRecordingsResponse;
use Faker\Factory as Faker;
use Faker\Generator;

/**
 * Class TestCase.
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Faker::create();
    }

    protected function createRealMeeting(BigBlueButton $bbb): CreateMeetingResponse
    {
        $createMeetingParams = $this->generateCreateParams();
        $createMeetingMock = $this->getCreateMock($createMeetingParams);

        return $bbb->createMeeting($createMeetingMock);
    }

    protected function generateCreateParams(): array
    {
        return [
            'name' => $this->faker->name,
            'meetingID' => $this->faker->uuid,
            'autoStartRecording' => $this->faker->boolean(50),
            'dialNumber' => $this->faker->phoneNumber,
            'voiceBridge' => $this->faker->randomNumber(5, true),
            'webVoice' => $this->faker->word,
            'logoutURL' => $this->faker->url,
            'maxParticipants' => $this->faker->numberBetween(2, 100),
            'record' => $this->faker->boolean(50),
            'duration' => $this->faker->numberBetween(0, 6000),
            'welcome' => $this->faker->sentence,
            'allowStartStopRecording' => $this->faker->boolean(50),
            'moderatorOnlyMessage' => $this->faker->sentence,
            'webcamsOnlyForModerator' => $this->faker->boolean(50),
            'logo' => $this->faker->imageUrl(330, 70),
            'copyright' => $this->faker->text,
            'guestPolicy' => $this->faker->randomElement([GuestPolicy::ALWAYS_ACCEPT, GuestPolicy::ALWAYS_DENY, GuestPolicy::ASK_MODERATOR]),
            'muteOnStart' => $this->faker->boolean(50),
            'lockSettingsDisableCam' => $this->faker->boolean(50),
            'lockSettingsDisableMic' => $this->faker->boolean(50),
            'lockSettingsDisablePrivateChat' => $this->faker->boolean(50),
            'lockSettingsDisablePublicChat' => $this->faker->boolean(50),
            'lockSettingsDisableNotes' => $this->faker->boolean(50),
            'lockSettingsHideUserList' => $this->faker->boolean(50),
            'lockSettingsLockedLayout' => $this->faker->boolean(50),
            'lockSettingsLockOnJoin' => $this->faker->boolean(50),
            'lockSettingsLockOnJoinConfigurable' => $this->faker->boolean(50),
            'allowModsToUnmuteUsers' => $this->faker->boolean(50),
            'allowModsToEjectCameras' => $this->faker->boolean(50),
            'disabledFeatures' => $this->faker->randomElements(Feature::cases(), 3),
            'disabledFeaturesExclude' => $this->faker->randomElements(Feature::cases(), 2),
            'meta_presenter' => $this->faker->name,
            'meta_endCallbackUrl' => $this->faker->url,
            'meta_bbb-recording-ready-url' => $this->faker->url,
            'bannerText' => $this->faker->sentence,
            'bannerColor' => $this->faker->hexColor,
            'meetingKeepEvents' => $this->faker->boolean(50),
            'endWhenNoModerator' => $this->faker->boolean(50),
            'endWhenNoModeratorDelayInMinutes' => $this->faker->numberBetween(1, 100),
            'meetingLayout' => $this->faker->randomElement([
                MeetingLayout::CUSTOM_LAYOUT,
                MeetingLayout::SMART_LAYOUT,
                MeetingLayout::PRESENTATION_FOCUS,
                MeetingLayout::VIDEO_FOCUS,
            ]),
            'learningDashboardCleanupDelayInMinutes' => $this->faker->numberBetween(1, 100),
            'breakoutRoomsPrivateChatEnabled' => $this->faker->boolean(50),
            'meetingEndedURL' => $this->faker->url,
            'breakoutRoomsRecord' => $this->faker->boolean(50),
            'allowRequestsWithoutSession' => $this->faker->boolean(50),
            'userCameraCap' => $this->faker->numberBetween(1, 5),
            'groups' => $this->generateBreakoutRoomsGroups(),
        ];
    }

    /**
     * @return array<array{id: string, name: string, roster: array}>
     */
    protected function generateBreakoutRoomsGroups(): array
    {
        $br = $this->faker->numberBetween(0, 8);
        $groups = [];
        for ($i = 0; $i <= $br; ++$i) {
            $groups[] = ['id' => $this->faker->uuid, 'name' => $this->faker->name, 'roster' => $this->faker->randomElements];
        }

        return $groups;
    }

    protected function generateBreakoutCreateParams(array $createParams): array
    {
        return array_merge($createParams, [
            'isBreakout' => true,
            'parentMeetingId' => $this->faker->uuid,
            'sequence' => $this->faker->numberBetween(1, 8),
            'freeJoin' => $this->faker->boolean(50),
        ]);
    }

    protected function getCreateMock(array $params): CreateMeetingParameters
    {
        $createMeetingParams = new CreateMeetingParameters($params['meetingID'], $params['name']);

        $createMeetingParams->setDialNumber($params['dialNumber'])
            ->setVoiceBridge($params['voiceBridge'])
            ->setWebVoice($params['webVoice'])
            ->setLogoutURL($params['logoutURL'])
            ->setMaxParticipants($params['maxParticipants'])
            ->setRecord($params['record'])
            ->setDuration($params['duration'])
            ->setWelcome($params['welcome'])
            ->setAutoStartRecording($params['autoStartRecording'])
            ->setAllowStartStopRecording($params['allowStartStopRecording'])
            ->setModeratorOnlyMessage($params['moderatorOnlyMessage'])
            ->setWebcamsOnlyForModerator($params['webcamsOnlyForModerator'])
            ->setLogo($params['logo'])
            ->setCopyright($params['copyright'])
            ->setEndCallbackUrl($params['meta_endCallbackUrl'])
            ->setRecordingReadyCallbackUrl($params['meta_bbb-recording-ready-url'])
            ->setMuteOnStart($params['muteOnStart'])
            ->setLockSettingsDisableCam($params['lockSettingsDisableCam'])
            ->setLockSettingsDisableMic($params['lockSettingsDisableMic'])
            ->setLockSettingsDisablePrivateChat($params['lockSettingsDisablePrivateChat'])
            ->setLockSettingsDisablePublicChat($params['lockSettingsDisablePublicChat'])
            ->setLockSettingsDisableNotes($params['lockSettingsDisableNotes'])
            ->setLockSettingsHideUserList($params['lockSettingsHideUserList'])
            ->setLockSettingsLockedLayout($params['lockSettingsLockedLayout'])
            ->setLockSettingsLockOnJoin($params['lockSettingsLockOnJoin'])
            ->setLockSettingsLockOnJoinConfigurable($params['lockSettingsLockOnJoinConfigurable'])
            ->setAllowModsToUnmuteUsers($params['allowModsToUnmuteUsers'])
            ->setGuestPolicy($params['guestPolicy'])
            ->addMeta('presenter', $params['meta_presenter'])
            ->setBannerText($params['bannerText'])
            ->setBannerColor($params['bannerColor'])
            ->setMeetingKeepEvents($params['meetingKeepEvents'])
            ->setEndWhenNoModerator($params['endWhenNoModerator'])
            ->setEndWhenNoModeratorDelayInMinutes($params['endWhenNoModeratorDelayInMinutes'])
            ->setAllowModsToEjectCameras($params['allowModsToEjectCameras'])
            ->setMeetingEndedURL($params['meetingEndedURL'])
            ->setMeetingLayout($params['meetingLayout'])
            ->setMeetingKeepEvents($params['meetingKeepEvents'])
            ->setLearningDashboardCleanupDelayInMinutes($params['learningDashboardCleanupDelayInMinutes'])
            ->setAllowModsToEjectCameras($params['allowModsToEjectCameras'])
            ->setBreakoutRoomsPrivateChatEnabled($params['breakoutRoomsPrivateChatEnabled'])
            ->setBreakoutRoomsRecord($params['breakoutRoomsRecord'])
            ->setAllowRequestsWithoutSession($params['allowRequestsWithoutSession'])
            ->setUserCameraCap($params['userCameraCap'])
            ->setDisabledFeatures($params['disabledFeatures'])
            ->setDisabledFeaturesExclude($params['disabledFeaturesExclude']);

        foreach ($params['groups'] as $group) {
            $createMeetingParams->addBreakoutRoomsGroup($group['id'], $group['name'], $group['roster']);
        }

        return $createMeetingParams;
    }

    protected function getBreakoutCreateMock(array $params): CreateMeetingParameters
    {
        $createMeetingParams = $this->getCreateMock($params);

        return $createMeetingParams->setBreakout($params['isBreakout'])->setParentMeetingID($params['parentMeetingId'])->setSequence($params['sequence'])->setFreeJoin($params['freeJoin']);
    }

    protected function generateJoinMeetingParams(): array
    {
        return ['meetingID' => $this->faker->uuid,
                'fullName' => $this->faker->name,
                'role' => $this->faker->randomElement(Role::cases()),
                'userID' => $this->faker->numberBetween(1, 1000),
                'webVoiceConf' => $this->faker->word,
                'createTime' => $this->faker->unixTime,
                'errorRedirectUrl' => $this->faker->url,
                'userdata-countrycode' => $this->faker->countryCode,
                'userdata-email' => $this->faker->email,
                'userdata-commercial' => false,
        ];
    }

    protected function getJoinMeetingMock(array $params): JoinMeetingParameters
    {
        $joinMeetingParams = new JoinMeetingParameters($params['meetingID'], $params['fullName'], $params['role']);

        $joinMeetingParams
            ->setUserID($params['userID'])
            ->setWebVoiceConf($params['webVoiceConf'])
            ->setCreateTime($params['createTime'])
            ->setErrorRedirectUrl($params['errorRedirectUrl'])
            ->addUserData('countrycode', $params['userdata-countrycode'])
            ->addUserData('email', $params['userdata-email'])
            ->addUserData('commercial', $params['userdata-commercial']);

        return $joinMeetingParams;
    }

    protected function generateEndMeetingParams(): array
    {
        return [
            'meetingID' => $this->faker->uuid,
        ];
    }

    protected function getEndMeetingMock(array $params): EndMeetingParameters
    {
        return new EndMeetingParameters($params['meetingID']);
    }

    protected function updateRecordings(BigBlueButton $bbb): UpdateRecordingsResponse
    {
        $updateRecordingsParams = $this->generateUpdateRecordingsParams();
        $updateRecordingsMock = $this->getUpdateRecordingsParamsMock($updateRecordingsParams);

        return $bbb->updateRecordings($updateRecordingsMock);
    }

    protected function generateUpdateRecordingsParams(): array
    {
        return [
            'recordID' => $this->faker->uuid,
            'meta_presenter' => $this->faker->name,
        ];
    }

    protected function getUpdateRecordingsParamsMock(array $params): UpdateRecordingsParameters
    {
        $updateRecordingParameters = new UpdateRecordingsParameters($params['recordID']);
        $updateRecordingParameters->addMeta('presenter', $params['meta_presenter']);

        return $updateRecordingParameters;
    }

    // Load fixtures

    protected function loadXmlFile(string $path): \SimpleXMLElement
    {
        return simplexml_load_string(file_get_contents($path));
    }

    protected function loadJsonFile(string $path): string
    {
        return file_get_contents($path);
    }

    protected function minifyString(string $string): string
    {
        return str_replace(["\r\n", "\r", "\n", "\t", ' '], '', (string) $string);
    }

    // Additional assertions

    /**
     * @param array<string> $getters
     */
    public function assertEachGetterValueIsString(object $obj, array $getters): void
    {
        foreach ($getters as $getterName) {
            $this->assertIsString($obj->$getterName(), 'Got a '.\gettype($obj->$getterName()).' instead of a string for property -> '.$getterName);
        }
    }

    /**
     * @param array<string> $getters
     */
    public function assertEachGetterValueIsInteger(object $obj, array $getters): void
    {
        foreach ($getters as $getterName) {
            $this->assertIsInt($obj->$getterName(), 'Got a '.\gettype($obj->$getterName()).' instead of an integer for property -> '.$getterName);
        }
    }

    /**
     * @param array<string> $getters
     */
    public function assertEachGetterValueIsDouble(object $obj, array $getters): void
    {
        foreach ($getters as $getterName) {
            $this->assertIsFloat($obj->$getterName(), 'Got a '.\gettype($obj->$getterName()).' instead of a double for property -> '.$getterName);
        }
    }

    /**
     * @param array<string> $getters
     */
    public function assertEachGetterValueIsBoolean(object $obj, array $getters): void
    {
        foreach ($getters as $getterName) {
            $this->assertIsBool($obj->$getterName(), 'Got a '.\gettype($obj->$getterName()).' instead of a boolean for property -> '.$getterName);
        }
    }

    public function assertUrlContainsAllRequestParameters(string $url, array $parameters): void
    {
        foreach ($parameters as $parameter) {
            if (\is_bool($parameter)) {
                $parameter = $parameter ? 'true' : 'false';
            }

            if ($parameter instanceof \BackedEnum) {
                $parameter = $parameter->value;
            }

            if (!\is_array($parameter)) {
                $this->assertStringContainsString((string) $parameter, urldecode($url));
            } else {
                $this->assertUrlContainsAllRequestParameters($url, $parameter);
            }
        }
    }
}
