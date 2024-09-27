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

namespace BigBlueButton\Parameters;

use BigBlueButton\Enum\Feature;
use BigBlueButton\Enum\GuestPolicy;
use BigBlueButton\Enum\MeetingLayout;

/**
 * @method string    getName()
 * @method $this     setName(string $name)
 * @method string    getMeetingID()
 * @method $this     setMeetingID(string $id)
 * @method string    getWelcome()
 * @method $this     setWelcome(string $welcome)
 * @method string    getDialNumber()
 * @method $this     setDialNumber(string $dialNumber)
 * @method int       getVoiceBridge()
 * @method $this     setVoiceBridge(int $voiceBridge)
 * @method string    getWebVoice()
 * @method $this     setWebVoice(string $webVoice)
 * @method int       getMaxParticipants()
 * @method $this     setMaxParticipants(int $maxParticipants)
 * @method string    getLogoutURL()
 * @method $this     setLogoutURL(string $logoutURL)
 * @method bool|null isRecord()
 * @method $this     setRecord(bool $isRecord)
 * @method bool|null isNotifyRecordingIsOn()
 * @method $this     setNotifyRecordingIsOn(bool $isNotifyRecordingIsOn)
 * @method bool|null isRemindRecordingIsOn()
 * @method $this     setRemindRecordingIsOn(bool $remindRecordingIsOn)
 * @method bool|null isRecordFullDurationMedia()
 * @method $this     setRecordFullDurationMedia(bool $recordFullDurationMedia)
 * @method int       getDuration()
 * @method $this     setDuration(int $duration)
 * @method string    getParentMeetingID()
 * @method $this     setParentMeetingID(string $parentMeetingID)
 * @method int       getSequence()
 * @method $this     setSequence(int $sequence)
 * @method bool|null isFreeJoin()
 * @method $this     setFreeJoin(bool $isFreeJoin)
 * @method bool|null isBreakoutRoomsPrivateChatEnabled()
 * @method $this     setBreakoutRoomsPrivateChatEnabled(bool $isBreakoutRoomsPrivateChatEnabled)
 * @method bool|null isBreakoutRoomsRecord()
 * @method $this     setBreakoutRoomsRecord(bool $isBreakoutRoomsRecord)
 * @method string    getModeratorOnlyMessage()
 * @method $this     setModeratorOnlyMessage(string $message)
 * @method bool|null isAutoStartRecording()
 * @method $this     setAutoStartRecording(bool $isAutoStartRecording)
 * @method bool|null isAllowStartStopRecording()
 * @method $this     setAllowStartStopRecording(bool $isAllow)
 * @method bool|null isWebcamsOnlyForModerator()
 * @method $this     setWebcamsOnlyForModerator(bool $isWebcamsOnlyForModerator)
 * @method string    getLogo()
 * @method $this     setLogo(string $logo)
 * @method string    getDarklogo()
 * @method $this     setDarklogo(string $darklogo)
 * @method string    getBannerText()
 * @method $this     setBannerText(string $bannerText)
 * @method string    getBannerColor()
 * @method $this     setBannerColor(string $bannerColor)
 * @method string    getCopyright()
 * @method $this     setCopyright(string $copyright)
 * @method bool|null isMuteOnStart()
 * @method $this     setMuteOnStart(bool $isMuteOnStart)
 * @method bool|null isAllowModsToUnmuteUsers()
 * @method $this     setAllowModsToUnmuteUsers(bool $isAllowModsToUnmuteUsers)
 * @method bool|null isLockSettingsDisableCam()
 * @method $this     setLockSettingsDisableCam(bool $isLockSettingsDisableCam)
 * @method bool|null isLockSettingsDisableMic()
 * @method $this     setLockSettingsDisableMic(bool $isLockSettingsDisableMic)
 * @method bool|null isLockSettingsDisablePrivateChat()
 * @method $this     setLockSettingsDisablePrivateChat(bool $isLockSettingsDisablePrivateChat)
 * @method bool|null isLockSettingsDisablePublicChat()
 * @method $this     setLockSettingsDisablePublicChat(bool $isLockSettingsDisablePublicChat)
 * @method bool|null isLockSettingsDisableNotes()
 * @method $this     setLockSettingsDisableNotes(bool $isLockSettingsDisableNotes)
 * @method bool|null isLockSettingsLockedLayout()
 * @method $this     setLockSettingsLockedLayout(bool $isLockSettingsLockedLayout)
 * @method bool|null isLockSettingsHideUserList()
 * @method $this     setLockSettingsHideUserList(bool $isLockSettingsHideUserList)
 * @method bool|null isLockSettingsLockOnJoin()
 * @method $this     setLockSettingsLockOnJoin(bool $isLockSettingsLockOnJoin)
 * @method bool|null isLockSettingsLockOnJoinConfigurable()
 * @method $this     setLockSettingsLockOnJoinConfigurable(bool $isLockSettingsLockOnJoinConfigurable)
 * @method $this     setLockSettingsHideViewersCursor(bool $isLockSettingsHideViewersCursor)
 * @method bool|null isLockSettingsHideViewersCursor()
 * @method string    getGuestPolicy()
 * @method $this     setGuestPolicy(string $guestPolicy)
 * @method bool|null isMeetingKeepEvents()
 * @method $this     setMeetingKeepEvents(bool $isMeetingKeepEvents)
 * @method bool|null isEndWhenNoModerator()
 * @method $this     setEndWhenNoModerator(bool $isEndWhenNoModerator)
 * @method int       getEndWhenNoModeratorDelayInMinutes()
 * @method $this     setEndWhenNoModeratorDelayInMinutes(int $endWhenNoModeratorDelayInMinutes)
 * @method int       getMeetingExpireIfNoUserJoinedInMinutes()
 * @method $this     setMeetingExpireIfNoUserJoinedInMinutes(int $meetingExpireIfNoUserJoinedInMinutes)
 * @method int       getMeetingExpireWhenLastUserLeftInMinutes()
 * @method $this     setMeetingExpireWhenLastUserLeftInMinutes(int $meetingExpireWhenLastUserLeftInMinutes)
 * @method string    getMeetingLayout()
 * @method $this     setMeetingLayout(MeetingLayout $meetingLayout)
 * @method string    getMeetingEndedURL()
 * @method $this     setMeetingEndedURL(string $meetingEndedURL)
 * @method int       getLearningDashboardCleanupDelayInMinutes()
 * @method $this     setLearningDashboardCleanupDelayInMinutes(int $learningDashboardCleanupDelayInMinutes)
 * @method bool|null isAllowModsToEjectCameras()
 * @method $this     setAllowModsToEjectCameras(bool $isAllowModsToEjectCameras)
 * @method bool|null isAllowRequestsWithoutSession()
 * @method $this     setAllowRequestsWithoutSession(bool $isAllowRequestsWithoutSession)
 * @method bool|null isAllowPromoteGuestToModerator()
 * @method $this     setAllowPromoteGuestToModerator(bool $isAllowPromoteGuestToModerator)
 * @method int       getUserCameraCap()
 * @method $this     setUserCameraCap(int $cap)
 * @method int       getMeetingCameraCap()
 * @method $this     setMeetingCameraCap(int $cap)
 * @method array     getDisabledFeatures()
 * @method $this     setDisabledFeatures(array $disabledFeatures)
 * @method array     getDisabledFeaturesExclude()
 * @method $this     setDisabledFeaturesExclude(array $disabledFeaturesExclude)
 * @method bool|null isPreUploadedPresentationOverrideDefault()
 * @method $this     setPreUploadedPresentationOverrideDefault(bool $preUploadedPresentationOverrideDefault)
 * @method string    getPresentationUploadExternalUrl()
 * @method $this     setPresentationUploadExternalUrl(string $presentationUploadExternalUrl)
 * @method string    getPresentationUploadExternalDescription()
 * @method $this     setPresentationUploadExternalDescription(string $presentationUploadExternalDescription)
 * @method string    getPreUploadedPresentation()
 * @method $this     setPreUploadedPresentation(string $preUploadedPresentation)
 * @method string    getPreUploadedPresentationName()
 * @method $this     setPreUploadedPresentationName(string $preUploadedPresentationName)
 */
class CreateMeetingParameters extends MetaParameters
{
    protected ?string $welcome = null;
    protected ?string $dialNumber = null;
    protected ?int $voiceBridge = null;
    protected ?string $webVoice = null;
    protected ?int $maxParticipants = null;
    protected ?string $logoutURL = null;
    protected ?bool $record = null;
    protected ?int $duration = null;
    protected ?bool $isBreakout = null;
    protected ?string $parentMeetingID = null;
    protected ?int $sequence = null;
    protected ?bool $freeJoin = null;
    protected ?bool $breakoutRoomsPrivateChatEnabled = null;
    protected ?bool $breakoutRoomsRecord = null;
    protected ?string $moderatorOnlyMessage = null;
    protected ?bool $autoStartRecording = null;
    protected ?bool $allowStartStopRecording = null;
    protected ?bool $webcamsOnlyForModerator = null;
    protected ?string $logo = null;
    protected ?string $darklogo = null;
    protected ?string $bannerText = null;
    protected ?string $bannerColor = null;
    protected ?string $copyright = null;
    protected ?bool $muteOnStart = null;
    protected ?bool $allowModsToUnmuteUsers = null;
    protected ?bool $lockSettingsDisableCam = null;
    protected ?bool $lockSettingsDisableMic = null;
    protected ?bool $lockSettingsDisablePrivateChat = null;
    protected ?bool $lockSettingsDisablePublicChat = null;
    protected ?bool $lockSettingsDisableNotes = null;
    protected ?bool $lockSettingsLockedLayout = null;
    protected ?bool $lockSettingsHideUserList = null;
    protected ?bool $lockSettingsLockOnJoin = null;
    protected ?bool $lockSettingsLockOnJoinConfigurable = null;
    protected ?bool $lockSettingsHideViewersCursor = null;
    protected GuestPolicy $guestPolicy;
    protected ?bool $meetingKeepEvents = null;
    protected ?bool $endWhenNoModerator = null;
    protected int $endWhenNoModeratorDelayInMinutes;

    protected ?MeetingLayout $meetingLayout = null;
    protected ?string $meetingEndedURL = null;
    protected ?int $learningDashboardCleanupDelayInMinutes = null;
    protected ?bool $allowModsToEjectCameras = null;
    protected ?bool $allowRequestsWithoutSession = null;
    protected ?bool $allowPromoteGuestToModerator = null;
    protected ?int $userCameraCap = null;

    /**
     * @var array<array{id: string, name: string|null, roster: array<mixed>}>
     */
    private array $breakoutRoomsGroups = [];

    /**
     * @var array<Feature>
     */
    protected array $disabledFeatures = [];

    /**
     * @var array<Feature>
     */
    protected array $disabledFeaturesExclude = [];

    protected ?int $meetingCameraCap = null;
    protected ?int $meetingExpireIfNoUserJoinedInMinutes = null;
    protected ?int $meetingExpireWhenLastUserLeftInMinutes = null;
    protected ?bool $preUploadedPresentationOverrideDefault = null;
    protected ?string $preUploadedPresentation = null;
    protected ?string $preUploadedPresentationName = null;
    protected ?bool $notifyRecordingIsOn = null;
    protected ?bool $remindRecordingIsOn = null;
    protected ?bool $recordFullDurationMedia = null;
    protected ?string $presentationUploadExternalUrl = null;
    protected ?string $presentationUploadExternalDescription = null;

    /**
     * @var array<string,string>
     */
    private array $presentations = [];

    public function __construct(protected string $meetingID, protected string $name)
    {
        $this->guestPolicy = GuestPolicy::ALWAYS_ACCEPT;

        $this->ignoreProperties = ['disabledFeatures', 'disabledFeaturesExclude'];
    }

    public function setEndCallbackUrl(string $endCallbackUrl): self
    {
        $this->addMeta('endCallbackUrl', $endCallbackUrl);

        return $this;
    }

    public function setRecordingReadyCallbackUrl(string $recordingReadyCallbackUrl): self
    {
        $this->addMeta('bbb-recording-ready-url', $recordingReadyCallbackUrl);

        return $this;
    }

    public function setBreakout(bool $isBreakout): self
    {
        $this->isBreakout = $isBreakout;

        return $this;
    }

    public function isBreakout(): ?bool
    {
        return $this->isBreakout;
    }

    public function isUserCameraCapDisabled(): bool
    {
        return $this->userCameraCap === 0;
    }

    public function disableUserCameraCap(): self
    {
        $this->userCameraCap = 0;

        return $this;
    }

    public function isGuestPolicyAlwaysDeny(): bool
    {
        return $this->guestPolicy === GuestPolicy::ALWAYS_DENY;
    }

    public function setGuestPolicyAlwaysDeny(): self
    {
        $this->guestPolicy = GuestPolicy::ALWAYS_DENY;

        return $this;
    }

    public function isGuestPolicyAskModerator(): bool
    {
        return $this->guestPolicy === GuestPolicy::ASK_MODERATOR;
    }

    /**
     * Ask moderator on join of non-moderators if user/guest is allowed to enter the meeting.
     */
    public function setGuestPolicyAskModerator(): self
    {
        $this->guestPolicy = GuestPolicy::ASK_MODERATOR;

        return $this;
    }

    public function isGuestPolicyAlwaysAcceptAuth(): bool
    {
        return $this->guestPolicy === GuestPolicy::ALWAYS_ACCEPT_AUTH;
    }

    /**
     * Ask moderator on join of guests is allowed to enter the meeting, user are allowed to join directly.
     */
    public function setGuestPolicyAlwaysAcceptAuth(): self
    {
        $this->guestPolicy = GuestPolicy::ALWAYS_ACCEPT_AUTH;

        return $this;
    }

    public function isGuestPolicyAlwaysAccept(): bool
    {
        return $this->guestPolicy === GuestPolicy::ALWAYS_ACCEPT;
    }

    public function setGuestPolicyAlwaysAccept(): self
    {
        $this->guestPolicy = GuestPolicy::ALWAYS_ACCEPT;

        return $this;
    }

    public function addPresentation(string $nameOrUrl, ?string $content = null, ?string $filename = null): self
    {
        if (!$filename) {
            $this->presentations[$nameOrUrl] = !$content ?: base64_encode($content);
        } else {
            $this->presentations[$nameOrUrl] = $filename;
        }

        return $this;
    }

    /**
     * @return array<array{id: string, name: string|null, roster: array<mixed>}>
     */
    public function getBreakoutRoomsGroups(): array
    {
        return $this->breakoutRoomsGroups;
    }

    /**
     * @param array<mixed> $roster
     *
     * @return $this
     */
    public function addBreakoutRoomsGroup(string $id, ?string $name, array $roster): self
    {
        $this->breakoutRoomsGroups[] = ['id' => $id, 'name' => $name, 'roster' => $roster];

        return $this;
    }

    /** @return array<string,string> */
    public function getPresentations(): array
    {
        return $this->presentations;
    }

    public function getPresentationsAsXML(): string|false
    {
        $result = '';

        if (!empty($this->presentations)) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><modules/>');
            $module = $xml->addChild('module');
            $module->addAttribute('name', 'presentation');

            foreach ($this->presentations as $nameOrUrl => $content) {
                if (str_starts_with($nameOrUrl, 'http')) {
                    $presentation = $module->addChild('document');
                    $presentation->addAttribute('url', $nameOrUrl);
                    if (\is_string($content)) {
                        $presentation->addAttribute('filename', $content);
                    }
                } else {
                    $document = $module->addChild('document');
                    $document->addAttribute('name', $nameOrUrl);
                    /* @phpstan-ignore-next-line */
                    $document[0] = $content;
                }
            }
            $result = $xml->asXML();
        }

        return $result;
    }

    public function getHTTPQuery(): string
    {
        $queries = $this->getHTTPQueryArray();

        // Add disabled features if any are set
        if (!empty($this->disabledFeatures)) {
            $queries = array_merge($queries, [
                'disabledFeatures' => implode(',', array_map(fn (Feature $disabledFeature): string => $disabledFeature->value, $this->disabledFeatures)),
            ]);
        }

        // Add disabled features exclude if any are set
        if (!empty($this->disabledFeaturesExclude)) {
            $queries = array_merge($queries, [
                'disabledFeaturesExclude' => implode(',', array_map(fn (Feature $disabledFeatureExclude): string => $disabledFeatureExclude->value, $this->disabledFeaturesExclude)),
            ]);
        }

        // Pre-defined groups to automatically assign the students to a given breakout room
        if (!empty($this->breakoutRoomsGroups)) {
            $queries = array_merge($queries, [
                'groups' => json_encode($this->breakoutRoomsGroups),
            ]);
        }

        if ($this->isBreakout()) {
            if ($this->parentMeetingID === null || $this->sequence === null) {
                throw new \RuntimeException('Breakout rooms require a parentMeetingID and sequence number.');
            }
        } else {
            $queries = $this->filterBreakoutRelatedQueries($queries);
        }

        return http_build_query($queries, '', '&', \PHP_QUERY_RFC3986);
    }

    /**
     * @param array<string> $queries
     *
     * @return array<string>
     */
    private function filterBreakoutRelatedQueries(array $queries): array
    {
        return array_filter($queries, static fn ($query) => !\in_array($query, ['isBreakout', 'parentMeetingID', 'sequence', 'freeJoin']));
    }
}
