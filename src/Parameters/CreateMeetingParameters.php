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

/**
 * @method string    getName()
 * @method $this     setName(string $name)
 * @method string    getMeetingID()
 * @method $this     setMeetingID(string $id)
 * @method string    getWelcome()
 * @method $this     setWelcome(string $welcome)
 * @method string    getDialNumber()
 * @method $this     setDialNumber(string $dialNumber)
 * @method string    getVoiceBridge()
 * @method $this     setVoiceBridge(string $voiceBridge)
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
 * @method $this     setMeetingLayout(string $meetingLayout)
 * @method string    getMeetingEndedURL()
 * @method $this     setMeetingEndedURL(string $meetingEndedURL)
 * @method int       getLearningDashboardCleanupDelayInMinutes()
 * @method $this     setLearningDashboardCleanupDelayInMinutes(int $learningDashboardCleanupDelayInMinutes)
 * @method bool|null isAllowModsToEjectCameras()
 * @method $this     setAllowModsToEjectCameras(bool $isAllowModsToEjectCameras)
 * @method bool|null isAllowRequestsWithoutSession()
 * @method $this     setAllowRequestsWithoutSession(bool $isAllowRequestsWithoutSession)
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
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $meetingID;

    /**
     * @var string|null
     */
    protected $attendeePW;

    /**
     * @var string|null
     */
    protected $moderatorPW;

    /**
     * @var string
     */
    protected $welcome;

    /**
     * @var string
     */
    protected $dialNumber;

    /**
     * @var string
     */
    protected $voiceBridge;

    /**
     * @var string
     */
    protected $webVoice;

    /**
     * @var int
     */
    protected $maxParticipants;

    /**
     * @var string
     */
    protected $logoutURL;

    /**
     * @var bool
     */
    protected $record;

    /**
     * @var int
     */
    protected $duration;

    /**
     * @var bool
     */
    protected $isBreakout;

    /**
     * @var string
     */
    protected $parentMeetingID;

    /**
     * @var int
     */
    protected $sequence;

    /**
     * @var bool
     */
    protected $freeJoin;

    /**
     * @var bool
     */
    protected $breakoutRoomsEnabled;

    /**
     * @var bool
     */
    protected $breakoutRoomsPrivateChatEnabled;

    /**
     * @var bool
     */
    protected $breakoutRoomsRecord;

    /**
     * @var string
     */
    protected $moderatorOnlyMessage;

    /**
     * @var bool
     */
    protected $autoStartRecording;

    /**
     * @var bool
     */
    protected $allowStartStopRecording;

    /**
     * @var bool
     */
    protected $webcamsOnlyForModerator;

    /**
     * @var string
     */
    protected $logo;

    /**
     * @var string
     */
    protected $bannerText;

    /**
     * @var string
     */
    protected $bannerColor;

    /**
     * @var string
     */
    protected $copyright;

    /**
     * @var bool
     */
    protected $muteOnStart;

    /**
     * @var bool
     */
    protected $allowModsToUnmuteUsers;

    /**
     * @var bool
     */
    protected $lockSettingsDisableCam;

    /**
     * @var bool
     */
    protected $lockSettingsDisableMic;

    /**
     * @var bool
     */
    protected $lockSettingsDisablePrivateChat;

    /**
     * @var bool
     */
    protected $lockSettingsDisablePublicChat;

    /**
     * @var bool
     */
    protected $lockSettingsDisableNotes;

    /**
     * @var bool
     */
    protected $lockSettingsLockedLayout;

    /**
     * @var bool
     */
    protected $lockSettingsHideUserList;

    /**
     * @var bool
     */
    protected $lockSettingsLockOnJoin;

    /**
     * @var bool
     */
    protected $lockSettingsLockOnJoinConfigurable;

    /**
     * @var bool
     */
    protected $lockSettingsHideViewersCursor;

    /**
     * @var string
     */
    protected $guestPolicy = GuestPolicy::ALWAYS_ACCEPT;

    /**
     * @var bool
     */
    protected $meetingKeepEvents;

    /**
     * @var bool
     */
    protected $endWhenNoModerator;

    /**
     * @var int
     */
    protected $endWhenNoModeratorDelayInMinutes;

    /**
     * @var string
     */
    protected $meetingLayout;

    /**
     * @var string
     */
    protected $meetingEndedURL;

    /**
     * @var bool
     */
    protected $learningDashboardEnabled;

    /**
     * @var int
     */
    protected $learningDashboardCleanupDelayInMinutes;

    /**
     * @var bool
     */
    protected $allowModsToEjectCameras;

    /**
     * @var bool
     */
    protected $allowRequestsWithoutSession;

    /**
     * @var bool
     */
    protected $virtualBackgroundsDisabled;

    /**
     * @var int
     */
    protected $userCameraCap;

    /**
     * @var array<array{id: string, name: string|null, roster: array}>
     */
    private $breakoutRoomsGroups = [];

    /**
     * @var array
     */
    protected $disabledFeatures = [];

    /**
     * @var array
     */
    protected $disabledFeaturesExclude = [];

    /**
     * @var int
     */
    protected $meetingCameraCap;

    /**
     * @var int
     */
    protected $meetingExpireIfNoUserJoinedInMinutes;

    /**
     * @var int
     */
    protected $meetingExpireWhenLastUserLeftInMinutes;

    /**
     * @var bool
     */
    protected $preUploadedPresentationOverrideDefault;

    /**
     * @var string
     */
    protected $preUploadedPresentation;

    /**
     * @var string
     */
    protected $preUploadedPresentationName;

    /**
     * @var bool
     */
    protected $notifyRecordingIsOn;

    /**
     * @var bool
     */
    protected $remindRecordingIsOn;

    /**
     * @var bool
     */
    protected $recordFullDurationMedia;

    /**
     * @var string
     */
    protected $presentationUploadExternalUrl;

    /**
     * @var string
     */
    protected $presentationUploadExternalDescription;

    /**
     * @var array
     */
    private $presentations = [];

    public function __construct(string $meetingID, string $name)
    {
        $this->ignoreProperties = ['disabledFeatures', 'disabledFeaturesExclude'];

        $this->meetingID = $meetingID;
        $this->name = $name;
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

    /**
     * @deprecated use disabledFeatures instead
     * Backwards compatibility for the old method name with the missing 's' at the end
     */
    public function setLockSettingsDisableNote(bool $isLockSettingsDisableNote): self
    {
        $this->isLockSettingsDisableNotes = $isLockSettingsDisableNote;

        return $this;
    }

    /**
     * @deprecated use disabledFeatures instead
     * Backwards compatibility for the old method name with the missing 's' at the end
     */
    public function isLockSettingsDisableNote(): bool
    {
        return $this->isLockSettingsDisableNotes;
    }

    /**
     * @deprecated Use disabledFeatures instead
     */
    public function setLearningDashboardEnabled(bool $learningDashboardEnabled): self
    {
        $this->learningDashboardEnabled = $learningDashboardEnabled;

        return $this;
    }

    /**
     * @deprecated Use disabledFeatures instead
     */
    public function isLearningDashboardEnabled(): bool
    {
        return $this->learningDashboardEnabled;
    }

    /**
     * @deprecated Use disabledFeatures instead
     */
    public function setVirtualBackgroundsDisabled(bool $virtualBackgroundsDisabled): self
    {
        $this->virtualBackgroundsDisabled = $virtualBackgroundsDisabled;

        return $this;
    }

    /**
     * @deprecated Use disabledFeatures instead
     */
    public function isVirtualBackgroundsDisabled(): bool
    {
        return $this->virtualBackgroundsDisabled;
    }

    /**
     * @deprecated Use disabledFeatures instead
     */
    public function setBreakoutRoomsEnabled(bool $breakoutRoomsEnabled): self
    {
        $this->breakoutRoomsEnabled = $breakoutRoomsEnabled;

        return $this;
    }

    /**
     * @deprecated Use disabledFeatures instead
     */
    public function isBreakoutRoomsEnabled(): bool
    {
        return $this->breakoutRoomsEnabled;
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
     * @return array<array{id: string, name: string|null, roster: array}>
     */
    public function getBreakoutRoomsGroups(): array
    {
        return $this->breakoutRoomsGroups;
    }

    /**
     * @return $this
     */
    public function addBreakoutRoomsGroup(string $id, ?string $name, array $roster): self
    {
        $this->breakoutRoomsGroups[] = ['id' => $id, 'name' => $name, 'roster' => $roster];

        return $this;
    }

    public function getPresentations(): array
    {
        return $this->presentations;
    }

    public function getPresentationsAsXML()
    {
        $result = '';

        if (!empty($this->presentations)) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><modules/>');
            $module = $xml->addChild('module');
            $module->addAttribute('name', 'presentation');

            foreach ($this->presentations as $nameOrUrl => $content) {
                if (strpos($nameOrUrl, 'http') === 0) {
                    $presentation = $module->addChild('document');
                    $presentation->addAttribute('url', $nameOrUrl);
                    if (\is_string($content)) {
                        $presentation->addAttribute('filename', $content);
                    }
                } else {
                    $document = $module->addChild('document');
                    $document->addAttribute('name', $nameOrUrl);
                    $document[0] = $content;
                }
            }
            $result = $xml->asXML();
        }

        return $result;
    }

    /**
     * @deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter.
     */
    public function getAttendeePW(): string
    {
        if (null === $this->attendeePW) {
            throw new \RuntimeException(sprintf('Attendee password was not passed to "%s".', self::class));
        }

        return $this->attendeePW;
    }

    /**
     * @deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter.
     *
     * @return $this
     */
    public function setAttendeePW(string $attendeePW): self
    {
        @trigger_error(sprintf('Passing a attendee password to "%s::setAttendeePW()" is deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the attendee password to create a meeting.', self::class), \E_USER_DEPRECATED);

        $this->attendeePW = $attendeePW;

        return $this;
    }

    /**
     * @deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter.
     */
    public function getModeratorPW(): string
    {
        if (null === $this->moderatorPW) {
            throw new \RuntimeException(sprintf('Moderator password was not passed to "%s".', self::class));
        }

        return $this->moderatorPW;
    }

    /**
     * @deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the password parameter.
     *
     * @return $this
     */
    public function setModeratorPW(string $moderatorPW): self
    {
        @trigger_error(sprintf('Passing a moderator password to "%s::setModeratorPW()" is deprecated since 5.1 and will be removed in 6.0. Recent BigBlueButton versions does not require the moderator password to create a meeting.', self::class), \E_USER_DEPRECATED);

        $this->moderatorPW = $moderatorPW;

        return $this;
    }

    public function getHTTPQuery(): string
    {
        $queries = $this->getHTTPQueryArray();

        // Add disabled features if any are set
        if (!empty($this->disabledFeatures)) {
            $queries = array_merge($queries, [
                'disabledFeatures' => implode(',', $this->disabledFeatures),
            ]);
        }

        // Add disabled features exclude if any are set
        if (!empty($this->disabledFeaturesExclude)) {
            $queries = array_merge($queries, [
                'disabledFeaturesExclude' => implode(',', $this->disabledFeaturesExclude),
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

    private function filterBreakoutRelatedQueries(array $queries): array
    {
        return array_filter($queries, function ($query) {
            return !\in_array($query, ['isBreakout', 'parentMeetingID', 'sequence', 'freeJoin']);
        });
    }
}
